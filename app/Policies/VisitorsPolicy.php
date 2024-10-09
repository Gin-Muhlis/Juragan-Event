<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visitors;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the visitors can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allvisitors');
    }

    /**
     * Determine whether the visitors can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Visitors  $model
     * @return mixed
     */
    public function view(User $user, Visitors $model)
    {
        return $user->hasPermissionTo('view allvisitors');
    }

    /**
     * Determine whether the visitors can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allvisitors');
    }

    /**
     * Determine whether the visitors can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Visitors  $model
     * @return mixed
     */
    public function update(User $user, Visitors $model)
    {
        return $user->hasPermissionTo('update allvisitors');
    }

    /**
     * Determine whether the visitors can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Visitors  $model
     * @return mixed
     */
    public function delete(User $user, Visitors $model)
    {
        return $user->hasPermissionTo('delete allvisitors');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Visitors  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allvisitors');
    }

    /**
     * Determine whether the visitors can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Visitors  $model
     * @return mixed
     */
    public function restore(User $user, Visitors $model)
    {
        return false;
    }

    /**
     * Determine whether the visitors can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Visitors  $model
     * @return mixed
     */
    public function forceDelete(User $user, Visitors $model)
    {
        return false;
    }
}
