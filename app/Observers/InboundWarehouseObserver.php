<?php

namespace App\Observers;

use App\Models\InboundWarehouse;

class InboundWarehouseObserver
{
    /**
     * Handle the InboundWarehouse "created" event.
     *
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return void
     */
    public function creating(InboundWarehouse $inboundWarehouse)
    {
        $inboundWarehouse->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundWarehouse "updated" event.
     *
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return void
     */
    public function updating(InboundWarehouse $inboundWarehouse)
    {
        $inboundWarehouse->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundWarehouse "deleted" event.
     *
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return void
     */
    public function deleted(InboundWarehouse $inboundWarehouse)
    {
        //
    }

    /**
     * Handle the InboundWarehouse "restored" event.
     *
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return void
     */
    public function restored(InboundWarehouse $inboundWarehouse)
    {
        //
    }

    /**
     * Handle the InboundWarehouse "force deleted" event.
     *
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return void
     */
    public function forceDeleted(InboundWarehouse $inboundWarehouse)
    {
        //
    }
}
