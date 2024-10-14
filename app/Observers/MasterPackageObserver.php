<?php

namespace App\Observers;

use App\Models\MasterPackage;

class MasterPackageObserver
{
    /**
     * Handle the master package "created" event.
     *
     * @param  \App\MasterPackage  $masterPackage
     * @return void
     */
    public function creating(MasterPackage $masterPackage)
    {
        $user = auth()->user();

        $masterPackage->created_by = $user->id;
    }

    /**
     * Handle the master package "updated" event.
     *
     * @param  \App\MasterPackage  $masterPackage
     * @return void
     */
    public function updating(MasterPackage $masterPackage)
    {
        /* $masterPackage->updated_by = auth()->user()->id; */
    }

    /**
     * Handle the master package "deleted" event.
     *
     * @param  \App\MasterPackage  $masterPackage
     * @return void
     */
    public function deleted(MasterPackage $masterPackage)
    {
        //
    }

    /**
     * Handle the master package "restored" event.
     *
     * @param  \App\MasterPackage  $masterPackage
     * @return void
     */
    public function restored(MasterPackage $masterPackage)
    {
        //
    }

    /**
     * Handle the master package "force deleted" event.
     *
     * @param  \App\MasterPackage  $masterPackage
     * @return void
     */
    public function forceDeleted(MasterPackage $masterPackage)
    {
        //
    }
}
