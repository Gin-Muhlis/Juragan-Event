<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the topic can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list topics');
    }

    /**
     * Determine whether the topic can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Topic  $model
     * @return mixed
     */
    public function view(User $user, Topic $model)
    {
        return $user->hasPermissionTo('view topics');
    }

    /**
     * Determine whether the topic can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create topics');
    }

    /**
     * Determine whether the topic can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Topic  $model
     * @return mixed
     */
    public function update(User $user, Topic $model)
    {
        return $user->hasPermissionTo('update topics');
    }

    /**
     * Determine whether the topic can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Topic  $model
     * @return mixed
     */
    public function delete(User $user, Topic $model)
    {
        return $user->hasPermissionTo('delete topics');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Topic  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete topics');
    }

    /**
     * Determine whether the topic can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Topic  $model
     * @return mixed
     */
    public function restore(User $user, Topic $model)
    {
        return false;
    }

    /**
     * Determine whether the topic can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Topic  $model
     * @return mixed
     */
    public function forceDelete(User $user, Topic $model)
    {
        return false;
    }
}
