<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FormatMix;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormatMixPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the formatMix can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list formatmixes');
    }

    /**
     * Determine whether the formatMix can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FormatMix  $model
     * @return mixed
     */
    public function view(User $user, FormatMix $model)
    {
        return $user->hasPermissionTo('view formatmixes');
    }

    /**
     * Determine whether the formatMix can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create formatmixes');
    }

    /**
     * Determine whether the formatMix can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FormatMix  $model
     * @return mixed
     */
    public function update(User $user, FormatMix $model)
    {
        return $user->hasPermissionTo('update formatmixes');
    }

    /**
     * Determine whether the formatMix can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FormatMix  $model
     * @return mixed
     */
    public function delete(User $user, FormatMix $model)
    {
        return $user->hasPermissionTo('delete formatmixes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FormatMix  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete formatmixes');
    }

    /**
     * Determine whether the formatMix can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FormatMix  $model
     * @return mixed
     */
    public function restore(User $user, FormatMix $model)
    {
        return false;
    }

    /**
     * Determine whether the formatMix can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FormatMix  $model
     * @return mixed
     */
    public function forceDelete(User $user, FormatMix $model)
    {
        return false;
    }
}
