<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\InventoryHistory;

class InventoryObserver
{
    /**
     * Handle the Inventory "created" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function creating(Inventory $inventory)
    {
        $inventory->created_by = auth()->user()->id;
    }

    public function created(Inventory $inventory)
    {
        $inventory
            ->histories()
            ->create([
                "type" => "inbound",
                "quantity" => $inventory->quantity,
                "current_quantity" => $inventory->quantity
            ]);
    }

    /**
     * Handle the Inventory "updated" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function updating(Inventory $inventory)
    {
        $inventory->updated_by = auth()->user()->id;
    }

    /**
     * Handle the Inventory "deleted" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function deleted(Inventory $inventory)
    {
        //
    }

    /**
     * Handle the Inventory "restored" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function restored(Inventory $inventory)
    {
        //
    }

    /**
     * Handle the Inventory "force deleted" event.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return void
     */
    public function forceDeleted(Inventory $inventory)
    {
        //
    }
}
