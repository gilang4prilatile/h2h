<?php

namespace App\Observers;

use App\Models\Inbound;
use App\Models\InboundHistory;

class InboundObserver
{
    /**
     * Handle the Inbound "created" event.
     *
     * @param  \App\Models\Inbound  $inbound
     * @return void
     */
    public function creating(Inbound $inbound)
    {
        $inbound->created_by = auth()->user()->id;
    }

    public function created(Inbound $inbound)
    {
        $inbound->histories()->create(["status_id" => $inbound->status_id]);
    }

    /**
     * Handle the Inbound "updated" event.
     *
     * @param  \App\Models\Inbound  $inbound
     * @return void
     */
    public function updating(Inbound $inbound)
    {
        $inbound->updated_by = auth()->user()->id;
    }

    public function updated(Inbound $inbound)
    {
        $lastHistory = $inbound->histories()->latest()->first();
        if ($lastHistory->status_id != $inbound->status_id) {
            $inbound->histories()->create(["status_id" => $inbound->status_id]);
        }
    }

    /**
     * Handle the Inbound "deleted" event.
     *
     * @param  \App\Models\Inbound  $inbound
     * @return void
     */
    public function deleted(Inbound $inbound)
    {
        //
    }

    /**
     * Handle the Inbound "restored" event.
     *
     * @param  \App\Models\Inbound  $inbound
     * @return void
     */
    public function restored(Inbound $inbound)
    {
        //
    }

    /**
     * Handle the Inbound "force deleted" event.
     *
     * @param  \App\Models\Inbound  $inbound
     * @return void
     */
    public function forceDeleted(Inbound $inbound)
    {
        //
    }
}
