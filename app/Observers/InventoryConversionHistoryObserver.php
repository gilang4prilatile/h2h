<?php

namespace App\Observers;

use App\Models\InventoryConversionHistory;

class InventoryConversionHistoryObserver
{
    /**
     * Handle the InventoryConversionHistory "created" event.
     *
     * @param  \App\Models\InventoryConversionHistory  $inventoryConversionHistory
     * @return void
     */
    public function creating(InventoryConversionHistory $inventoryConversionHistory)
    {
        $inventoryConversionHistory->created_by = auth()->user()->id;
    }

    public function created(InventoryConversionHistory $inventoryConversionHistory)
    {
        /* if ($inventoryConversionHistory->type == "conversion") { */
        /*     $inventory = $inventoryConversionHistory->inventory()->first(); */
        /*     $inventoryHistory = $inventory->histories()->create([ */
        /*         "type" => "converted", */
        /*         "quantity" => $inventoryConversionHistory->quantity, */
        /*         "current_quantity" => $inventory->quantity */
        /*     ]); */
        /*     return; */
        /* } */
    }

    /**
     * Handle the InventoryConversionHistory "updated" event.
     *
     * @param  \App\Models\InventoryConversionHistory  $inventoryConversionHistory
     * @return void
     */
    public function updating(InventoryConversionHistory $inventoryConversionHistory)
    {
        $inventoryConversionHistory->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InventoryConversionHistory "deleted" event.
     *
     * @param  \App\Models\InventoryConversionHistory  $inventoryConversionHistory
     * @return void
     */
    public function deleted(InventoryConversionHistory $inventoryConversionHistory)
    {
        //
    }

    /**
     * Handle the InventoryConversionHistory "restored" event.
     *
     * @param  \App\Models\InventoryConversionHistory  $inventoryConversionHistory
     * @return void
     */
    public function restored(InventoryConversionHistory $inventoryConversionHistory)
    {
        //
    }

    /**
     * Handle the InventoryConversionHistory "force deleted" event.
     *
     * @param  \App\Models\InventoryConversionHistory  $inventoryConversionHistory
     * @return void
     */
    public function forceDeleted(InventoryConversionHistory $inventoryConversionHistory)
    {
        //
    }
}
