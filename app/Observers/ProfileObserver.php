<?php

namespace App\Observers;

use App\Models\Profile;

class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function creating(Profile $profile)
    {
        $profile->created_by = auth()->user()->id;
    }

    /**
     * Handle the Profile "updated" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function updating(Profile $profile)
    {
        $profile->updated_by = auth()->user()->id;
    }

    /**
     * Handle the Profile "deleted" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function deleted(Profile $profile)
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function restored(Profile $profile)
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function forceDeleted(Profile $profile)
    {
        //
    }
}
