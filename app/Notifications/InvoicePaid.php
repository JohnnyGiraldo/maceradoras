<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    protected $maceradora;

    public function __construct($maceradora)
    {
        $this->maceradora = $maceradora;
    }

    public function toMail($notifiable)
    {
        $maintenanceDate = $this->maceradora->fechaInstalacion->addMonths(6)->subDays(5);

        return (new MailMessage)
            ->line('Recuerda que es hora de realizar el mantenimiento a la maceradora.')
            ->line('Fecha de mantenimiento: ' . $maintenanceDate)
            ->action('Realizar mantenimiento', url('/maintenance'))
            ->line('¡Gracias por usar nuestra aplicación!');
    }
}