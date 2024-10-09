<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the city can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list cities');
    }

    /**
     * Determine whether the city can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\City  $model
     * @return mixed
     */
    public function view(User $user, City $model)
    {
        return $user->hasPermissionTo('view cities');
    }

    /**
     * Determine whether the city can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create cities');
    }

    /**
     * Determine whether the city can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\City  $model
     * @return mixed
     */
    public function update(User $user, City $model)
    {
        return $user->hasPermissionTo('update cities');
    }

    /**
     * Determine whether the city can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\City  $model
     * @return mixed
     */
    public function delete(User $user, City $model)
    {
        return $user->hasPermissionTo('delete cities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\City  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete cities');
    }

    /**
     * Determine whether the city can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\City  $model
     * @return mixed
     */
    public function restore(User $user, City $model)
    {
        return false;
    }

    /**
     * Determine whether the city can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\City  $model
     * @return mixed
     */
    public function forceDelete(User $user, City $model)
    {
        return false;
    }
}
