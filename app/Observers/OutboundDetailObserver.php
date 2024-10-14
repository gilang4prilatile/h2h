<?php

namespace App\Observers;

use App\Models\InventoryHistory;
use App\Models\OutboundDetail;

class OutboundDetailObserver
{
    /**
     * Handle the OutboundDetail "created" event.
     *
     * @param  \App\Models\OutboundDetail  $outboundDetail
     * @return void
     */
    public function creating(OutboundDetail $outboundDetail)
    {
        $outboundDetail->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundDetail "updated" event.
     *
     * @param  \App\Models\OutboundDetail  $outboundDetail
     * @return void
     */
    public function updating(OutboundDetail $outboundDetail)
    {
        $outboundDetail->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundDetail "deleted" event.
     *
     * @param  \App\Models\OutboundDetail  $outboundDetail
     * @return void
     */
    public function deleted(OutboundDetail $outboundDetail)
    {
        //
    }

    /**
     * Handle the OutboundDetail "restored" event.
     *
     * @param  \App\Models\OutboundDetail  $outboundDetail
     * @return void
     */
    public function restored(OutboundDetail $outboundDetail)
    {
        //
    }

    /**
     * Handle the OutboundDetail "force deleted" event.
     *
     * @param  \App\Models\OutboundDetail  $outboundDetail
     * @return void
     */
    public function forceDeleted(OutboundDetail $outboundDetail)
    {
        //
    }
}
