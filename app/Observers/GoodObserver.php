<?php

namespace App\Observers;

use App\Models\Good;

class GoodObserver
{
    /**
     * Handle the Good "created" event.
     *
     * @param  \App\Models\Good  $good
     * @return void
     */
    public function creating(Good $good)
    {
        $good->created_by = auth()->user()->id;
    }

    /**
     * Handle the Good "updated" event.
     *
     * @param  \App\Models\Good  $good
     * @return void
     */
    public function updating(Good $good)
    {
        $good->updated_by = auth()->user()->id;
    }

    /**
     * Handle the Good "deleted" event.
     *
     * @param  \App\Models\Good  $good
     * @return void
     */
    public function deleted(Good $good)
    {
        //
    }

    /**
     * Handle the Good "restored" event.
     *
     * @param  \App\Models\Good  $good
     * @return void
     */
    public function restored(Good $good)
    {
        //
    }

    /**
     * Handle the Good "force deleted" event.
     *
     * @param  \App\Models\Good  $good
     * @return void
     */
    public function forceDeleted(Good $good)
    {
        //
    }
}
