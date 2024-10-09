<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Juragan;
use Illuminate\Auth\Access\HandlesAuthorization;

class JuraganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the juragan can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list juragans');
    }

    /**
     * Determine whether the juragan can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Juragan  $model
     * @return mixed
     */
    public function view(User $user, Juragan $model)
    {
        return $user->hasPermissionTo('view juragans');
    }

    /**
     * Determine whether the juragan can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create juragans');
    }

    /**
     * Determine whether the juragan can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Juragan  $model
     * @return mixed
     */
    public function update(User $user, Juragan $model)
    {
        return $user->hasPermissionTo('update juragans');
    }

    /**
     * Determine whether the juragan can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Juragan  $model
     * @return mixed
     */
    public function delete(User $user, Juragan $model)
    {
        return $user->hasPermissionTo('delete juragans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Juragan  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete juragans');
    }

    /**
     * Determine whether the juragan can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Juragan  $model
     * @return mixed
     */
    public function restore(User $user, Juragan $model)
    {
        return false;
    }

    /**
     * Determine whether the juragan can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Juragan  $model
     * @return mixed
     */
    public function forceDelete(User $user, Juragan $model)
    {
        return false;
    }
}
