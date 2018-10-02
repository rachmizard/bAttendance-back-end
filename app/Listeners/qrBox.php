<?php

namespace App\Listeners;

use App\Events\qrTrigger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class qrBox
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  qrTrigger  $event
     * @return void
     */
    public function handle(qrTrigger $event)
    {
        //
    }
}
