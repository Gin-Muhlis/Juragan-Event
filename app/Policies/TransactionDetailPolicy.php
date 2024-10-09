<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TransactionDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transactionDetail can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list transactiondetails');
    }

    /**
     * Determine whether the transactionDetail can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionDetail  $model
     * @return mixed
     */
    public function view(User $user, TransactionDetail $model)
    {
        return $user->hasPermissionTo('view transactiondetails');
    }

    /**
     * Determine whether the transactionDetail can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create transactiondetails');
    }

    /**
     * Determine whether the transactionDetail can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionDetail  $model
     * @return mixed
     */
    public function update(User $user, TransactionDetail $model)
    {
        return $user->hasPermissionTo('update transactiondetails');
    }

    /**
     * Determine whether the transactionDetail can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionDetail  $model
     * @return mixed
     */
    public function delete(User $user, TransactionDetail $model)
    {
        return $user->hasPermissionTo('delete transactiondetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionDetail  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete transactiondetails');
    }

    /**
     * Determine whether the transactionDetail can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionDetail  $model
     * @return mixed
     */
    public function restore(User $user, TransactionDetail $model)
    {
        return false;
    }

    /**
     * Determine whether the transactionDetail can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionDetail  $model
     * @return mixed
     */
    public function forceDelete(User $user, TransactionDetail $model)
    {
        return false;
    }
}
