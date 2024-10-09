<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Galery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GaleryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the galery can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list galeries');
    }

    /**
     * Determine whether the galery can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Galery  $model
     * @return mixed
     */
    public function view(User $user, Galery $model)
    {
        return $user->hasPermissionTo('view galeries');
    }

    /**
     * Determine whether the galery can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create galeries');
    }

    /**
     * Determine whether the galery can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Galery  $model
     * @return mixed
     */
    public function update(User $user, Galery $model)
    {
        return $user->hasPermissionTo('update galeries');
    }

    /**
     * Determine whether the galery can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Galery  $model
     * @return mixed
     */
    public function delete(User $user, Galery $model)
    {
        return $user->hasPermissionTo('delete galeries');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Galery  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete galeries');
    }

    /**
     * Determine whether the galery can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Galery  $model
     * @return mixed
     */
    public function restore(User $user, Galery $model)
    {
        return false;
    }

    /**
     * Determine whether the galery can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Galery  $model
     * @return mixed
     */
    public function forceDelete(User $user, Galery $model)
    {
        return false;
    }
}
