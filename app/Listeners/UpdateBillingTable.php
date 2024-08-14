<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateBillingTable
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
    public function handle(object $event): void
    {
        Log::info('Listener UpdateBillingTable dipanggil', ['billing_id' => $event->billing->id]);
        DB::table('update_billing')->insert([
            'billing_id' => $event->billing->id,
            'updated_at' => now(),
            // tambahkan field lain sesuai kebutuhan Anda
        ]);
    }
}
