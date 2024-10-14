<?php

namespace App\Observers;

use App\Models\OutboundValas;

class OutboundValasObserver
{
    /**
     * Handle the OutboundValas "created" event.
     *
     * @param  \App\Models\OutboundValas  $outboundValas
     * @return void
     */
    public function creating(OutboundValas $outboundValas)
    {
        $outboundValas->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundValas "updated" event.
     *
     * @param  \App\Models\OutboundValas  $outboundValas
     * @return void
     */
    public function updating(OutboundValas $outboundValas)
    {
        $outboundValas->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundValas "deleted" event.
     *
     * @param  \App\Models\OutboundValas  $outboundValas
     * @return void
     */
    public function deleted(OutboundValas $outboundValas)
    {
        //
    }

    /**
     * Handle the OutboundValas "restored" event.
     *
     * @param  \App\Models\OutboundValas  $outboundValas
     * @return void
     */
    public function restored(OutboundValas $outboundValas)
    {
        //
    }

    /**
     * Handle the OutboundValas "force deleted" event.
     *
     * @param  \App\Models\OutboundValas  $outboundValas
     * @return void
     */
    public function forceDeleted(OutboundValas $outboundValas)
    {
        //
    }
}
