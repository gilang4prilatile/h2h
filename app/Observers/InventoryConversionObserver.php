<?php

namespace App\Observers;

use App\Models\InventoryConversion;
use DB;

class InventoryConversionObserver
{
    /**
     * Handle the InventoryConversion "created" event.
     *
     * @param  \App\Models\InventoryConversion  $inventoryConversion
     * @return void
     */
    public function creating(InventoryConversion $inventoryConversion)
    {
        $inventoryConversion->created_by = auth()->user()->id;
    }

    /**
     * Handle the InventoryConversion "updated" event.
     *
     * @param  \App\Models\InventoryConversion  $inventoryConversion
     * @return void
     */
    public function updating(InventoryConversion $inventoryConversion)
    {
        $inventoryConversion->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InventoryConversion "deleted" event.
     *
     * @param  \App\Models\InventoryConversion  $inventoryConversion
     * @return void
     */
    public function deleted(InventoryConversion $inventoryConversion)
    {
        //
    }

    /**
     * Handle the InventoryConversion "restored" event.
     *
     * @param  \App\Models\InventoryConversion  $inventoryConversion
     * @return void
     */
    public function restored(InventoryConversion $inventoryConversion)
    {
        //
    }

    /**
     * Handle the InventoryConversion "force deleted" event.
     *
     * @param  \App\Models\InventoryConversion  $inventoryConversion
     * @return void
     */
    public function forceDeleted(InventoryConversion $inventoryConversion)
    {
        //
    }
}
