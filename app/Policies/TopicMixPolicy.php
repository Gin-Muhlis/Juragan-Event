<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TopicMix;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicMixPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the topicMix can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list topicmixes');
    }

    /**
     * Determine whether the topicMix can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TopicMix  $model
     * @return mixed
     */
    public function view(User $user, TopicMix $model)
    {
        return $user->hasPermissionTo('view topicmixes');
    }

    /**
     * Determine whether the topicMix can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create topicmixes');
    }

    /**
     * Determine whether the topicMix can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TopicMix  $model
     * @return mixed
     */
    public function update(User $user, TopicMix $model)
    {
        return $user->hasPermissionTo('update topicmixes');
    }

    /**
     * Determine whether the topicMix can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TopicMix  $model
     * @return mixed
     */
    public function delete(User $user, TopicMix $model)
    {
        return $user->hasPermissionTo('delete topicmixes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TopicMix  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete topicmixes');
    }

    /**
     * Determine whether the topicMix can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TopicMix  $model
     * @return mixed
     */
    public function restore(User $user, TopicMix $model)
    {
        return false;
    }

    /**
     * Determine whether the topicMix can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TopicMix  $model
     * @return mixed
     */
    public function forceDelete(User $user, TopicMix $model)
    {
        return false;
    }
}
