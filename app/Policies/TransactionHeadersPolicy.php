<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TransactionHeaders;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionHeadersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transactionHeaders can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list alltransactionheaders');
    }

    /**
     * Determine whether the transactionHeaders can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionHeaders  $model
     * @return mixed
     */
    public function view(User $user, TransactionHeaders $model)
    {
        return $user->hasPermissionTo('view alltransactionheaders');
    }

    /**
     * Determine whether the transactionHeaders can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create alltransactionheaders');
    }

    /**
     * Determine whether the transactionHeaders can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionHeaders  $model
     * @return mixed
     */
    public function update(User $user, TransactionHeaders $model)
    {
        return $user->hasPermissionTo('update alltransactionheaders');
    }

    /**
     * Determine whether the transactionHeaders can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionHeaders  $model
     * @return mixed
     */
    public function delete(User $user, TransactionHeaders $model)
    {
        return $user->hasPermissionTo('delete alltransactionheaders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionHeaders  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete alltransactionheaders');
    }

    /**
     * Determine whether the transactionHeaders can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionHeaders  $model
     * @return mixed
     */
    public function restore(User $user, TransactionHeaders $model)
    {
        return false;
    }

    /**
     * Determine whether the transactionHeaders can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionHeaders  $model
     * @return mixed
     */
    public function forceDelete(User $user, TransactionHeaders $model)
    {
        return false;
    }
}
