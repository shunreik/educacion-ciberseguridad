<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
    use Queueable;

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
            ->subject(env('APP_NAME').' - Verificación de correo electrónico')
            ->greeting('Verificación de correo electrónico')
            ->line('Por favor, haga clic en el botón de abajo para verificar su dirección de correo electrónico.')
            ->action('Verificar la dirección de correo electrónico', $url)
            ->line('Si no ha creado una cuenta, no se requiere ninguna otra acción.')
            ->salutation('Saludos');
    }
}
