<?php

namespace App\Listeners;

// use App\Events\Registered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShowPostRegistrationMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        session()->flash('success', 'Usuario creado con éxito. Por favor, inicia sesión.');
    }
}
