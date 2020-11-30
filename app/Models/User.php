<?php

namespace App\Models;

use App\Mail\ResetPasswordNotification;
use App\Mail\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'nickname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Se modifica la relación modelo y roles
    /**
     * A model may have multiple roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->morphToMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            'role_id'
        )->withPivot('status');
    }
    //Se modifica la asignación de roles al modelo
    /**
     * Assign the given role to the model.
     *
     * @param array|string|\Spatie\Permission\Contracts\Role ...$roles
     *
     * @return $this
     */
    public function assignRole(...$roles)
    {
        // Se obtiene los id de los roles obtenidos como parámetros
        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) {
                if (empty($role)) {
                    return false;
                }

                return $this->getStoredRole($role);
            })
            ->filter(function ($role) {
                return $role instanceof Role;
            })
            ->each(function ($role) {
                $this->ensureModelSharesGuard($role);
            })
            ->map->id
            ->all();
        // dd($roles);

        //Se obtiene al modelo del usuario
        $model = $this->getModel();
        // dd($model);

        if ($model->exists) {
            // dd($this->roles());
            // $this->roles()->sync($roles, false);
            $this->roles()->attach($roles, ['status' => true]);
            $model->load('roles'); //se carga los roles del modelo
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($roles, $model) {
                    static $modelLastFiredOn;
                    if ($modelLastFiredOn !== null && $modelLastFiredOn === $model) {
                        return;
                    }
                    // $object->roles()->sync($roles, false);
                    $object->roles()->attach($roles, ['status' => true]);
                    $object->load('roles');
                    $modelLastFiredOn = $object;
                }
            );
        }

        $this->forgetCachedPermissions();

        return $this;
    }

    /**
     * Método para verificar si el usuario puede iniciar sesión
     * Para que el usuario pueda iniciar sesión debe tener asignado algún rol y que esta asignación
     * se encuentre activa, solamente no se permite iniciar sesión si el usuario no tiene ningún rol o
     * que todas las asignaciones de roles se encuentren desactivadas.
     * 
     * @param string|array|\Illuminate\Support\Collection  $roles
     *
     * @return bool
     * 
     */
    public function canUserLogIn($roles)
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $roles = array_map(function ($role) {
            if ($role instanceof Role) {
                return $role;
            }
            $method = is_numeric($role) ? 'findById' : 'findByName';
            return $this->getRoleClass()->{$method}($role);
        }, $roles);

        $roles = array_column($roles, 'name'); //Devuelve los valores de una sola columna del array de entrada

        if ($this->hasAnyRole($roles)) {
            foreach ($this->roles as $role) {
                if ($role->pivot->status) {
                    return true;
                }
            }
        }
        return false;
    }

    //Se modifica el método para enviar el correo de verificación de dirección email
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    //Se modeifica el método que envía el correo de restablecimiento de contrasenia
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Método que verifica el estado del rol asignado
     * 
     * @param string  $findRole
     *
     * @return bool
     * 
     */
    public function isUserActive($findRole){
        $rolesUser = $this->roles;
        $roleStatus = false;

        foreach ($rolesUser as $role) {
            if( $role->name == $findRole){
                $roleStatus = $role->pivot->status;
            }
        }

        return $roleStatus;
    }
}
