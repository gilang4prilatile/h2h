<?php

namespace App\Observers;

use App\Models\TransportLine;

class TransportLineObserver
{
    /**
     * Handle the TransportLine "created" event.
     *
     * @param  \App\Models\TransportLine  $transportLine
     * @return void
     */
    public function creating(TransportLine $transportLine)
    {
        $transportLine->created_by = auth()->user()->id;
    }

    /**
     * Handle the TransportLine "updated" event.
     *
     * @param  \App\Models\TransportLine  $transportLine
     * @return void
     */
    public function updating(TransportLine $transportLine)
    {
        $transportLine->updated_by = auth()->user()->id;
    }

    /**
     * Handle the TransportLine "deleted" event.
     *
     * @param  \App\Models\TransportLine  $transportLine
     * @return void
     */
    public function deleted(TransportLine $transportLine)
    {
        //
    }

    /**
     * Handle the TransportLine "restored" event.
     *
     * @param  \App\Models\TransportLine  $transportLine
     * @return void
     */
    public function restored(TransportLine $transportLine)
    {
        //
    }

    /**
     * Handle the TransportLine "force deleted" event.
     *
     * @param  \App\Models\TransportLine  $transportLine
     * @return void
     */
    public function forceDeleted(TransportLine $transportLine)
    {
        //
    }
}
