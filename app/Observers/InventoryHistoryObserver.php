<?php

namespace App\Observers;

use App\Models\InventoryHistory;

class InventoryHistoryObserver
{
    /**
     * Handle the InventoryHistory "created" event.
     *
     * @param  \App\Models\InventoryHistory  $inventoryHistory
     * @return void
     */
    public function creating(InventoryHistory $inventoryHistory)
    {
        $inventoryHistory->created_by = auth()->user()->id;
    }

    /**
     * Handle the InventoryHistory "updated" event.
     *
     * @param  \App\Models\InventoryHistory  $inventoryHistory
     * @return void
     */
    public function updating(InventoryHistory $inventoryHistory)
    {
        $inventoryHistory->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InventoryHistory "deleted" event.
     *
     * @param  \App\Models\InventoryHistory  $inventoryHistory
     * @return void
     */
    public function deleted(InventoryHistory $inventoryHistory)
    {
        //
    }

    /**
     * Handle the InventoryHistory "restored" event.
     *
     * @param  \App\Models\InventoryHistory  $inventoryHistory
     * @return void
     */
    public function restored(InventoryHistory $inventoryHistory)
    {
        //
    }

    /**
     * Handle the InventoryHistory "force deleted" event.
     *
     * @param  \App\Models\InventoryHistory  $inventoryHistory
     * @return void
     */
    public function forceDeleted(InventoryHistory $inventoryHistory)
    {
        //
    }
}
