<?php

namespace App\Observers;

use App\Models\Port;

class PortObserver
{
    /**
     * Handle the Port "created" event.
     *
     * @param  \App\Models\Port  $port
     * @return void
     */
    public function creating(Port $port)
    {
        $port->created_by = auth()->user()->id;
    }

    /**
     * Handle the Port "updated" event.
     *
     * @param  \App\Models\Port  $port
     * @return void
     */
    public function updating(Port $port)
    {
        $port->updated_by = auth()->user()->id;
    }

    /**
     * Handle the Port "deleted" event.
     *
     * @param  \App\Models\Port  $port
     * @return void
     */
    public function deleted(Port $port)
    {
        //
    }

    /**
     * Handle the Port "restored" event.
     *
     * @param  \App\Models\Port  $port
     * @return void
     */
    public function restored(Port $port)
    {
        //
    }

    /**
     * Handle the Port "force deleted" event.
     *
     * @param  \App\Models\Port  $port
     * @return void
     */
    public function forceDeleted(Port $port)
    {
        //
    }
}
