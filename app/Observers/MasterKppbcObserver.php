<?php

namespace App\Observers;

use App\Models\MasterKppbc;

class MasterKppbcObserver
{
    /**
     * Handle the master kppbc "created" event.
     *
     * @param  \App\MasterKppbc  $masterKppbc
     * @return void
     */
    public function creating(MasterKppbc $masterKppbc)
    {
        $user = auth()->user();

        $masterKppbc->created_by = $user->id;
    }

    /**
     * Handle the master kppbc "updated" event.
     *
     * @param  \App\MasterKppbc  $masterKppbc
     * @return void
     */
    public function updating(MasterKppbc $masterKppbc)
    {
        $masterKppbc->updated_by = auth()->user()->id;
    }

    /**
     * Handle the master kppbc "deleted" event.
     *
     * @param  \App\MasterKppbc  $masterKppbc
     * @return void
     */
    public function deleted(MasterKppbc $masterKppbc)
    {
        //
    }

    /**
     * Handle the master kppbc "restored" event.
     *
     * @param  \App\MasterKppbc  $masterKppbc
     * @return void
     */
    public function restored(MasterKppbc $masterKppbc)
    {
        //
    }

    /**
     * Handle the master kppbc "force deleted" event.
     *
     * @param  \App\MasterKppbc  $masterKppbc
     * @return void
     */
    public function forceDeleted(MasterKppbc $masterKppbc)
    {
        //
    }
}
