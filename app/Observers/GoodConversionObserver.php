<?php

namespace App\Observers;

use App\Models\GoodConversion;

class GoodConversionObserver
{
    /**
     * Handle the GoodConversion "created" event.
     *
     * @param  \App\Models\GoodConversion  $goodConversion
     * @return void
     */
    public function creating(GoodConversion $goodConversion)
    {
        $goodConversion->created_by = auth()->user()->id;
    }

    /**
     * Handle the GoodConversion "updated" event.
     *
     * @param  \App\Models\GoodConversion  $goodConversion
     * @return void
     */
    public function updating(GoodConversion $goodConversion)
    {
        $goodConversion->updated_by = auth()->user()->id;
    }

    /**
     * Handle the GoodConversion "deleted" event.
     *
     * @param  \App\Models\GoodConversion  $goodConversion
     * @return void
     */
    public function deleted(GoodConversion $goodConversion)
    {
        //
    }

    /**
     * Handle the GoodConversion "restored" event.
     *
     * @param  \App\Models\GoodConversion  $goodConversion
     * @return void
     */
    public function restored(GoodConversion $goodConversion)
    {
        //
    }

    /**
     * Handle the GoodConversion "force deleted" event.
     *
     * @param  \App\Models\GoodConversion  $goodConversion
     * @return void
     */
    public function forceDeleted(GoodConversion $goodConversion)
    {
        //
    }
}
