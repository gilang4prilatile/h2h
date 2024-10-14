<?php

namespace App\Policies;

use App\Models\InboundWarehouse;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InboundWarehousePolicy
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
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InboundWarehouse $inboundWarehouse)
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
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InboundWarehouse $inboundWarehouse)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InboundWarehouse $inboundWarehouse)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InboundWarehouse $inboundWarehouse)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\InboundWarehouse  $inboundWarehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InboundWarehouse $inboundWarehouse)
    {
        //
    }
}
