<?php

namespace App\Observers;

use App\Models\RatePreference;

class RatePreferencesObserver
{
    /**
     * Handle the RatePreference "created" event.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return void
     */
    public function creating(RatePreference $ratePreference)
    {
        $ratePreference->created_by = auth()->user()->id;
    }

    /**
     * Handle the RatePreference "updated" event.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return void
     */
    public function updating(RatePreference $ratePreference)
    {
        $ratePreference->updated_by = auth()->user()->id;
    }

    /**
     * Handle the RatePreference "deleted" event.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return void
     */
    public function deleted(RatePreference $ratePreference)
    {
        //
    }

    /**
     * Handle the RatePreference "restored" event.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return void
     */
    public function restored(RatePreference $ratePreference)
    {
        //
    }

    /**
     * Handle the RatePreference "force deleted" event.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return void
     */
    public function forceDeleted(RatePreference $ratePreference)
    {
        //
    }
}
