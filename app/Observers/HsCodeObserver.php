<?php

namespace App\Observers;

use App\Models\HsCode;

class HsCodeObserver
{
    /**
     * Handle the HsCode "created" event.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return void
     */
    public function creating(HsCode $hsCode)
    {
        $hsCode->created_by = auth()->user()->id;
    }

    /**
     * Handle the HsCode "updated" event.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return void
     */
    public function updating(HsCode $hsCode)
    {
        $hsCode->updated_by = auth()->user()->id;
    }

    /**
     * Handle the HsCode "deleted" event.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return void
     */
    public function deleted(HsCode $hsCode)
    {
        //
    }

    /**
     * Handle the HsCode "restored" event.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return void
     */
    public function restored(HsCode $hsCode)
    {
        //
    }

    /**
     * Handle the HsCode "force deleted" event.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return void
     */
    public function forceDeleted(HsCode $hsCode)
    {
        //
    }
}
