<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //

        return in_array("View sale", $user->simplePermissions);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Sale $sale)
    {
        //
        return in_array("View sale", $user->simplePermissions);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        return in_array("Create sale", $user->simplePermissions);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Sale $sale)
    {
        //
        return in_array("Edit sale", $user->simplePermissions);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Sale $sale)
    {
        //
        return in_array("Delete sale", $user->simplePermissions);

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Sale $sale)
    {
        //
        return in_array("Delete sale", $user->simplePermissions);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Sale $sale)
    {
        //
        return in_array("Delete sale", $user->simplePermissions);
    }
}