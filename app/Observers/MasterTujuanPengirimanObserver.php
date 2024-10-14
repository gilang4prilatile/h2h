<?php

namespace App\Observers;

use App\Models\MasterTujuanPengiriman;

class MasterTujuanPengirimanObserver
{
    /**
     * Handle the master tujuan pengiriman "created" event.
     *
     * @param  \App\Models\MasterTujuanPengiriman  $masterTujuanPengiriman
     * @return void
     */
    public function creating(MasterTujuanPengiriman $masterTujuanPengiriman)
    {
        $user = auth()->user();

        $masterTujuanPengiriman->created_by = $user->id;
    }

    /**
     * Handle the master tujuan pengiriman "updated" event.
     *
     * @param  \App\Models\MasterTujuanPengiriman  $masterTujuanPengiriman
     * @return void
     */
    public function updating(MasterTujuanPengiriman $masterTujuanPengiriman)
    {
        $masterTujuanPengiriman->updated_by = auth()->user()->id;
    }

    /**
     * Handle the master tujuan pengiriman "deleted" event.
     *
     * @param  \App\Models\MasterTujuanPengiriman  $masterTujuanPengiriman
     * @return void
     */
    public function deleted(MasterTujuanPengiriman $masterTujuanPengiriman)
    {
        //
    }

    /**
     * Handle the master tujuan pengiriman "restored" event.
     *
     * @param  \App\Models\MasterTujuanPengiriman  $masterTujuanPengiriman
     * @return void
     */
    public function restored(MasterTujuanPengiriman $masterTujuanPengiriman)
    {
        //
    }

    /**
     * Handle the master tujuan pengiriman "force deleted" event.
     *
     * @param  \App\Models\MasterTujuanPengiriman  $masterTujuanPengiriman
     * @return void
     */
    public function forceDeleted(MasterTujuanPengiriman $masterTujuanPengiriman)
    {
        //
    }
}
