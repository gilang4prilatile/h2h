<?php

namespace App\Observers;

use App\Models\Outbound;
use App\Models\OutboundHistory;

class OutboundObserver
{
    /**
     * Handle the Outbound "created" event.
     *
     * @param  \App\Models\Outbound  $outbound
     * @return void
     */
    public function creating(Outbound $outbound)
    {
        $outbound->created_by = auth()->user()->id;
    }

    public function created(Outbound $outbound)
    {
        $outbound->histories()->create(["status_id" => $outbound->status_id]);
    }
    /**
     * Handle the Outbound "updated" event.
     *
     * @param  \App\Models\Outbound  $outbound
     * @return void
     */
    public function updating(Outbound $outbound)
    {
        $outbound->updated_by = auth()->user()->id;
    }

    public function updated(Outbound $outbound)
    {
        $lastHistory = $outbound->histories()->latest()->first();
        if ($lastHistory->status_id != $outbound->status_id) {
            $outbound->histories()->create(["status_id" => $outbound->status_id]);
        }
    }

    /**
     * Handle the Outbound "deleted" event.
     *
     * @param  \App\Models\Outbound  $outbound
     * @return void
     */
    public function deleted(Outbound $outbound)
    {
        //
    }

    /**
     * Handle the Outbound "restored" event.
     *
     * @param  \App\Models\Outbound  $outbound
     * @return void
     */
    public function restored(Outbound $outbound)
    {
        //
    }

    /**
     * Handle the Outbound "force deleted" event.
     *
     * @param  \App\Models\Outbound  $outbound
     * @return void
     */
    public function forceDeleted(Outbound $outbound)
    {
        //
    }
}
