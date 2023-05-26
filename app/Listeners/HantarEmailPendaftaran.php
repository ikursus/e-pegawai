<?php

namespace App\Listeners;

use App\Notifications\NotisAkaunBaru;
use App\Events\PenggunaTelahMendaftar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HantarEmailPendaftaran
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
    public function handle(PenggunaTelahMendaftar $event): void
    {
        $user = $event->user;
        $user->notify(new NotisAkaunBaru($user));
    }
}
