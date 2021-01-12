<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyTeacherEmail extends VerifyEmailBase
{
    use Queueable;
    protected $password;
    protected $subject;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emailRecieved, $passwordRecived, $subjectRecieved = 'Registro de profesor')
    {
        $this->email = $emailRecieved;
        $this->password = $passwordRecived;
        $this->subject = $subjectRecieved;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }


     //Se configura el contenido del mensaje del correo de verificación de direción email
    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $verificationUrl
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(env('APP_NAME').' - '.$this->subject)
            ->greeting($this->subject)
            ->line('A continuación, puedes observar tus credenciales de acceso:')
            ->line('Correo electróncico: '.$this->email)
            ->line('Contraseña: '.$this->password)
            ->action('Verificar la dirección de correo electrónico', $url)
            ->line('Recuerda cambiar tu contraseña al ingresar a: '.env('APP_NAME'))
            ->salutation('Saludos');
    }
}
