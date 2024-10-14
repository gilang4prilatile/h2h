<?php

namespace App\Observers;

use App\Models\InboundValas;

class InboundValasObserver
{
    /**
     * Handle the InboundValas "created" event.
     *
     * @param  \App\Models\InboundValas  $inboundValas
     * @return void
     */
    public function creating(InboundValas $inboundValas)
    {
        $inboundValas->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundValas "updated" event.
     *
     * @param  \App\Models\InboundValas  $inboundValas
     * @return void
     */
    public function updating(InboundValas $inboundValas)
    {
        $inboundValas->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundValas "deleted" event.
     *
     * @param  \App\Models\InboundValas  $inboundValas
     * @return void
     */
    public function deleted(InboundValas $inboundValas)
    {
        //
    }

    /**
     * Handle the InboundValas "restored" event.
     *
     * @param  \App\Models\InboundValas  $inboundValas
     * @return void
     */
    public function restored(InboundValas $inboundValas)
    {
        //
    }

    /**
     * Handle the InboundValas "force deleted" event.
     *
     * @param  \App\Models\InboundValas  $inboundValas
     * @return void
     */
    public function forceDeleted(InboundValas $inboundValas)
    {
        //
    }
}
