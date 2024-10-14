<?php

namespace App\Observers;

use App\Models\OutboundKppbc;

class OutboundKppbcObserver
{
    /**
     * Handle the OutboundKppbc "created" event.
     *
     * @param  \App\Models\OutboundKppbc  $outboundKppbc
     * @return void
     */
    public function creating(OutboundKppbc $outboundKppbc)
    {
        $outboundKppbc->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundKppbc "updated" event.
     *
     * @param  \App\Models\OutboundKppbc  $outboundKppbc
     * @return void
     */
    public function updating(OutboundKppbc $outboundKppbc)
    {
        $outboundKppbc->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundKppbc "deleted" event.
     *
     * @param  \App\Models\OutboundKppbc  $outboundKppbc
     * @return void
     */
    public function deleted(OutboundKppbc $outboundKppbc)
    {
        //
    }

    /**
     * Handle the OutboundKppbc "restored" event.
     *
     * @param  \App\Models\OutboundKppbc  $outboundKppbc
     * @return void
     */
    public function restored(OutboundKppbc $outboundKppbc)
    {
        //
    }

    /**
     * Handle the OutboundKppbc "force deleted" event.
     *
     * @param  \App\Models\OutboundKppbc  $outboundKppbc
     * @return void
     */
    public function forceDeleted(OutboundKppbc $outboundKppbc)
    {
        //
    }
}
