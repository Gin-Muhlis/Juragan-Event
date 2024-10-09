<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Format;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the format can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list formats');
    }

    /**
     * Determine whether the format can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Format  $model
     * @return mixed
     */
    public function view(User $user, Format $model)
    {
        return $user->hasPermissionTo('view formats');
    }

    /**
     * Determine whether the format can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create formats');
    }

    /**
     * Determine whether the format can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Format  $model
     * @return mixed
     */
    public function update(User $user, Format $model)
    {
        return $user->hasPermissionTo('update formats');
    }

    /**
     * Determine whether the format can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Format  $model
     * @return mixed
     */
    public function delete(User $user, Format $model)
    {
        return $user->hasPermissionTo('delete formats');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Format  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete formats');
    }

    /**
     * Determine whether the format can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Format  $model
     * @return mixed
     */
    public function restore(User $user, Format $model)
    {
        return false;
    }

    /**
     * Determine whether the format can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Format  $model
     * @return mixed
     */
    public function forceDelete(User $user, Format $model)
    {
        return false;
    }
}
