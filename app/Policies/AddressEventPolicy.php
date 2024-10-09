<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AddressEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the addressEvent can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list addressevents');
    }

    /**
     * Determine whether the addressEvent can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AddressEvent  $model
     * @return mixed
     */
    public function view(User $user, AddressEvent $model)
    {
        return $user->hasPermissionTo('view addressevents');
    }

    /**
     * Determine whether the addressEvent can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create addressevents');
    }

    /**
     * Determine whether the addressEvent can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AddressEvent  $model
     * @return mixed
     */
    public function update(User $user, AddressEvent $model)
    {
        return $user->hasPermissionTo('update addressevents');
    }

    /**
     * Determine whether the addressEvent can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AddressEvent  $model
     * @return mixed
     */
    public function delete(User $user, AddressEvent $model)
    {
        return $user->hasPermissionTo('delete addressevents');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AddressEvent  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete addressevents');
    }

    /**
     * Determine whether the addressEvent can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AddressEvent  $model
     * @return mixed
     */
    public function restore(User $user, AddressEvent $model)
    {
        return false;
    }

    /**
     * Determine whether the addressEvent can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AddressEvent  $model
     * @return mixed
     */
    public function forceDelete(User $user, AddressEvent $model)
    {
        return false;
    }
}
