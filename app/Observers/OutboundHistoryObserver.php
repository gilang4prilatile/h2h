<?php

namespace App\Observers;

use App\Models\OutboundHistory;

class OutboundHistoryObserver
{
    /**
     * Handle the OutboundHistory "created" event.
     *
     * @param  \App\Models\OutboundHistory  $outboundHistory
     * @return void
     */
    public function creating(OutboundHistory $outboundHistory)
    {
        $outboundHistory->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundHistory "updated" event.
     *
     * @param  \App\Models\OutboundHistory  $outboundHistory
     * @return void
     */
    public function updating(OutboundHistory $outboundHistory)
    {
        $outboundHistory->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundHistory "deleted" event.
     *
     * @param  \App\Models\OutboundHistory  $outboundHistory
     * @return void
     */
    public function deleted(OutboundHistory $outboundHistory)
    {
        //
    }

    /**
     * Handle the OutboundHistory "restored" event.
     *
     * @param  \App\Models\OutboundHistory  $outboundHistory
     * @return void
     */
    public function restored(OutboundHistory $outboundHistory)
    {
        //
    }

    /**
     * Handle the OutboundHistory "force deleted" event.
     *
     * @param  \App\Models\OutboundHistory  $outboundHistory
     * @return void
     */
    public function forceDeleted(OutboundHistory $outboundHistory)
    {
        //
    }
}
