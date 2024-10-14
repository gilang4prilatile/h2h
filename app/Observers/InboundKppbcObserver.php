<?php

namespace App\Observers;

use App\Models\InboundKppbc;

class InboundKppbcObserver
{
    /**
     * Handle the InboundKppbc "created" event.
     *
     * @param  \App\Models\InboundKppbc  $inboundKppbc
     * @return void
     */
    public function creating(InboundKppbc $inboundKppbc)
    {
        $inboundKppbc->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundKppbc "updated" event.
     *
     * @param  \App\Models\InboundKppbc  $inboundKppbc
     * @return void
     */
    public function updating(InboundKppbc $inboundKppbc)
    {
        $inboundKppbc->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundKppbc "deleted" event.
     *
     * @param  \App\Models\InboundKppbc  $inboundKppbc
     * @return void
     */
    public function deleted(InboundKppbc $inboundKppbc)
    {
        //
    }

    /**
     * Handle the InboundKppbc "restored" event.
     *
     * @param  \App\Models\InboundKppbc  $inboundKppbc
     * @return void
     */
    public function restored(InboundKppbc $inboundKppbc)
    {
        //
    }

    /**
     * Handle the InboundKppbc "force deleted" event.
     *
     * @param  \App\Models\InboundKppbc  $inboundKppbc
     * @return void
     */
    public function forceDeleted(InboundKppbc $inboundKppbc)
    {
        //
    }
}
