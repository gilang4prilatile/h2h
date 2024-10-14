<?php

namespace App\Observers;

use App\Models\File;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function creating(File $file)
    {
        $file->created_by = auth()->user()->id;
    }

    /**
     * Handle the File "updated" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function updating(File $file)
    {
        $file->updated_by = auth()->user()->id;
    }

    /**
     * Handle the File "deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        //
    }

    /**
     * Handle the File "restored" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function restored(File $file)
    {
        //
    }

    /**
     * Handle the File "force deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function forceDeleted(File $file)
    {
        //
    }
}
