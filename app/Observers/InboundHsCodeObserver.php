<?php

namespace App\Observers;

use App\Models\InboundHsCode;

class InboundHsCodeObserver
{
    /**
     * Handle the InboundHsCode "created" event.
     *
     * @param  \App\Models\InboundHsCode  $inboundHsCode
     * @return void
     */
    public function creating(InboundHsCode $inboundHsCode)
    {
        $inboundHsCode->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundHsCode "updated" event.
     *
     * @param  \App\Models\InboundHsCode  $inboundHsCode
     * @return void
     */
    public function updating(InboundHsCode $inboundHsCode)
    {
        $inboundHsCode->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundHsCode "deleted" event.
     *
     * @param  \App\Models\InboundHsCode  $inboundHsCode
     * @return void
     */
    public function deleted(InboundHsCode $inboundHsCode)
    {
        //
    }

    /**
     * Handle the InboundHsCode "restored" event.
     *
     * @param  \App\Models\InboundHsCode  $inboundHsCode
     * @return void
     */
    public function restored(InboundHsCode $inboundHsCode)
    {
        //
    }

    /**
     * Handle the InboundHsCode "force deleted" event.
     *
     * @param  \App\Models\InboundHsCode  $inboundHsCode
     * @return void
     */
    public function forceDeleted(InboundHsCode $inboundHsCode)
    {
        //
    }
}
