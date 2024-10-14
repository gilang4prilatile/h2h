<?php

namespace App\Observers;

use App\Models\InboundTujuanPengiriman;

class InboundTujuanPengirimanObserver
{
    /**
     * Handle the InboundTujuanPengiriman "created" event.
     *
     * @param  \App\Models\InboundTujuanPengiriman  $inboundTujuanPengiriman
     * @return void
     */
    public function creating(InboundTujuanPengiriman $inboundTujuanPengiriman)
    {
        $inboundTujuanPengiriman->created_by = auth()->user()->id;
    }

    /**
     * Handle the InboundTujuanPengiriman "updated" event.
     *
     * @param  \App\Models\InboundTujuanPengiriman  $inboundTujuanPengiriman
     * @return void
     */
    public function updating(InboundTujuanPengiriman $inboundTujuanPengiriman)
    {
        $inboundTujuanPengiriman->updated_by = auth()->user()->id;
    }

    /**
     * Handle the InboundTujuanPengiriman "deleted" event.
     *
     * @param  \App\Models\InboundTujuanPengiriman  $inboundTujuanPengiriman
     * @return void
     */
    public function deleted(InboundTujuanPengiriman $inboundTujuanPengiriman)
    {
        //
    }

    /**
     * Handle the InboundTujuanPengiriman "restored" event.
     *
     * @param  \App\Models\InboundTujuanPengiriman  $inboundTujuanPengiriman
     * @return void
     */
    public function restored(InboundTujuanPengiriman $inboundTujuanPengiriman)
    {
        //
    }

    /**
     * Handle the InboundTujuanPengiriman "force deleted" event.
     *
     * @param  \App\Models\InboundTujuanPengiriman  $inboundTujuanPengiriman
     * @return void
     */
    public function forceDeleted(InboundTujuanPengiriman $inboundTujuanPengiriman)
    {
        //
    }
}
