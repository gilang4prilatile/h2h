<?php

namespace App\Observers;

use App\Models\MasterJenisTpb;

class MasterJenisTpbObserver
{
    /**
     * Handle the master jenis tpb "created" event.
     *
     * @param  \App\Models\MasterJenisTpb  $masterJenisTpb
     * @return void
     */
    public function creating(MasterJenisTpb $masterJenisTpb)
    {
        $user = auth()->user();

        $masterJenisTpb->created_by = $user->id;
    }

    /**
     * Handle the master jenis tpb "updated" event.
     *
     * @param  \App\Models\MasterJenisTpb  $masterJenisTpb
     * @return void
     */
    public function updating(MasterJenisTpb $masterJenisTpb)
    {
        $masterJenisTpb->updated_by = auth()->user()->id;
    }

    /**
     * Handle the master jenis tpb "deleted" event.
     *
     * @param  \App\Models\MasterJenisTpb  $masterJenisTpb
     * @return void
     */
    public function deleted(MasterJenisTpb $masterJenisTpb)
    {
        //
    }

    /**
     * Handle the master jenis tpb "restored" event.
     *
     * @param  \App\Models\MasterJenisTpb  $masterJenisTpb
     * @return void
     */
    public function restored(MasterJenisTpb $masterJenisTpb)
    {
        //
    }

    /**
     * Handle the master jenis tpb "force deleted" event.
     *
     * @param  \App\Models\MasterJenisTpb  $masterJenisTpb
     * @return void
     */
    public function forceDeleted(MasterJenisTpb $masterJenisTpb)
    {
        //
    }
}
