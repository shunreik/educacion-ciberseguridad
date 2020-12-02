<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends ResetPasswordBase
{
    use Queueable;

    //Se modifica el mensaje de restablecimiento de contrasenia
    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(env('APP_NAME').' - Restablecimiento de contraseña')
            ->greeting('Restablecimiento de contraseña')
            ->line('Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.')
            ->action('Restablecer contraseña', $url)
            ->line(Lang::get('Este enlace de restablecimiento de contraseña caducará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line('Si no ha solicitado un restablecimiento de contraseña, no se requiere ninguna otra acción.')
            ->salutation('Saludos');
    }
}
