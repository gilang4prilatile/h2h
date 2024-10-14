<?php

namespace App\Observers;

use App\Models\BcForm;

class BcFormObserver
{
    /**
     * Handle the BcForm "created" event.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return void
     */
    public function creating(BcForm $bcForm)
    {
        $bcForm->created_by = auth()->user()->id;
    }

    /**
     * Handle the BcForm "updated" event.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return void
     */
    public function updating(BcForm $bcForm)
    {
        $bcForm->updated_by = auth()->user()->id;
    }

    /**
     * Handle the BcForm "deleted" event.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return void
     */
    public function deleted(BcForm $bcForm)
    {
        //
    }

    /**
     * Handle the BcForm "restored" event.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return void
     */
    public function restored(BcForm $bcForm)
    {
        //
    }

    /**
     * Handle the BcForm "force deleted" event.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return void
     */
    public function forceDeleted(BcForm $bcForm)
    {
        //
    }
}
