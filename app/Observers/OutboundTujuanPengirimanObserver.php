<?php

namespace App\Observers;

use App\Models\OutboundTujuanPengiriman;

class OutboundTujuanPengirimanObserver
{
    /**
     * Handle the OutboundTujuanPengiriman "created" event.
     *
     * @param  \App\Models\OutboundTujuanPengiriman  $outboundTujuanPengiriman
     * @return void
     */
    public function creating(OutboundTujuanPengiriman $outboundTujuanPengiriman)
    {
        $outboundTujuanPengiriman->created_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundTujuanPengiriman "updated" event.
     *
     * @param  \App\Models\OutboundTujuanPengiriman  $outboundTujuanPengiriman
     * @return void
     */
    public function updating(OutboundTujuanPengiriman $outboundTujuanPengiriman)
    {
        $outboundTujuanPengiriman->updated_by = auth()->user()->id;
    }

    /**
     * Handle the OutboundTujuanPengiriman "deleted" event.
     *
     * @param  \App\Models\OutboundTujuanPengiriman  $outboundTujuanPengiriman
     * @return void
     */
    public function deleted(OutboundTujuanPengiriman $outboundTujuanPengiriman)
    {
        //
    }

    /**
     * Handle the OutboundTujuanPengiriman "restored" event.
     *
     * @param  \App\Models\OutboundTujuanPengiriman  $outboundTujuanPengiriman
     * @return void
     */
    public function restored(OutboundTujuanPengiriman $outboundTujuanPengiriman)
    {
        //
    }

    /**
     * Handle the OutboundTujuanPengiriman "force deleted" event.
     *
     * @param  \App\Models\OutboundTujuanPengiriman  $outboundTujuanPengiriman
     * @return void
     */
    public function forceDeleted(OutboundTujuanPengiriman $outboundTujuanPengiriman)
    {
        //
    }
}
