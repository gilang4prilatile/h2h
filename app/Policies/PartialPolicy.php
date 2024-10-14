<?php

namespace App\Policies;

use App\Models\partial;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartialPolicy
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
     * @param  \App\Models\partial  $partial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, partial $partial)
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
     * @param  \App\Models\partial  $partial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, partial $partial)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\partial  $partial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, partial $partial)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\partial  $partial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, partial $partial)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\partial  $partial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, partial $partial)
    {
        //
    }
}
