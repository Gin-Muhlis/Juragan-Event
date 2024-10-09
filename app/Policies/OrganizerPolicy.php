<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organizer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the organizer can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list organizers');
    }

    /**
     * Determine whether the organizer can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Organizer  $model
     * @return mixed
     */
    public function view(User $user, Organizer $model)
    {
        return $user->hasPermissionTo('view organizers');
    }

    /**
     * Determine whether the organizer can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create organizers');
    }

    /**
     * Determine whether the organizer can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Organizer  $model
     * @return mixed
     */
    public function update(User $user, Organizer $model)
    {
        return $user->hasPermissionTo('update organizers');
    }

    /**
     * Determine whether the organizer can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Organizer  $model
     * @return mixed
     */
    public function delete(User $user, Organizer $model)
    {
        return $user->hasPermissionTo('delete organizers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Organizer  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete organizers');
    }

    /**
     * Determine whether the organizer can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Organizer  $model
     * @return mixed
     */
    public function restore(User $user, Organizer $model)
    {
        return false;
    }

    /**
     * Determine whether the organizer can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Organizer  $model
     * @return mixed
     */
    public function forceDelete(User $user, Organizer $model)
    {
        return false;
    }
}
