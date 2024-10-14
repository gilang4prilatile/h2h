<?php

namespace App\Observers;

use App\Models\InboundDetail;

class InboundDetailObserver
{
    /**
     * Handle the InboundDetail "created" event.
     *
     * @param  \App\Models\InboundDetail  $inboundDetail
     * @return void
     */
    public function creating(InboundDetail $inboundDetail)
    {
        $inboundDetail->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundDetail "updated" event.
     *
     * @param  \App\Models\InboundDetail  $inboundDetail
     * @return void
     */
    public function updating(InboundDetail $inboundDetail)
    {
        $inboundDetail->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundDetail "deleted" event.
     *
     * @param  \App\Models\InboundDetail  $inboundDetail
     * @return void
     */
    public function deleted(InboundDetail $inboundDetail)
    {
        //
    }

    /**
     * Handle the InboundDetail "restored" event.
     *
     * @param  \App\Models\InboundDetail  $inboundDetail
     * @return void
     */
    public function restored(InboundDetail $inboundDetail)
    {
        //
    }

    /**
     * Handle the InboundDetail "force deleted" event.
     *
     * @param  \App\Models\InboundDetail  $inboundDetail
     * @return void
     */
    public function forceDeleted(InboundDetail $inboundDetail)
    {
        //
    }
}
