<?php

namespace App\Policies;

use App\Models\OutboundTransportLine;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OutboundTransportLinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OutboundTransportLine $outboundTransportLine)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OutboundTransportLine $outboundTransportLine)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OutboundTransportLine $outboundTransportLine)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OutboundTransportLine $outboundTransportLine)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\OutboundTransportLine  $outboundTransportLine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OutboundTransportLine $outboundTransportLine)
    {
        //
    }
}
