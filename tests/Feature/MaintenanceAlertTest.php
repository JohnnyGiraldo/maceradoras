<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Notifications\MaintenanceAlert;
use App\Models\User;
use Illuminate\Support\Facades\Notification;



class MaintenanceAlertTest extends TestCase
{
    public function testMaintenanceAlertIsSent()
    {
        Notification::fake();

        // Crea una instancia de Maceradora con una fecha de instalación y un usuario asociado
        $maceradora = factory(\App\Models\Maceradora::class)->create();
        $maceradora->user()->create(factory(User::class)->raw());

        // Ejecuta el comando para verificar las fechas
        $this->artisan('maceradora:check-dates');

        // Verifica que la notificación MaintenanceAlert se haya enviado
        Notification::assertSentTo(
            [$maceradora->user],
            MaintenanceAlert::class
        );
    }
}

