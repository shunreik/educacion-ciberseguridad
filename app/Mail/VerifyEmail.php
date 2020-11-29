<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends VerifyEmailBase
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->subject('Verificación de correo electrónico')
            ->greeting('Verificación de correo electrónico')
            ->line('Por favor, haga clic en el botón de abajo para verificar su dirección de correo electrónico.')
            ->action('Verificar la dirección de correo electrónico', $url)
            ->line('Si no ha creado una cuenta, no se requiere ninguna otra acción.')
            ->salutation('Saludos');
    }
}
