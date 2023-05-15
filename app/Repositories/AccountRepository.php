<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;

class AccountRepository
{
    private $account;
    public function __construct(User $account)
    {
        $this->account = $account;
    }

    public function create($attributes)
    {
        return $this->account->query()->create($attributes);
    }

    public function update($attributes,$id)
    {
        return $this->account->query()->find($id)->update($attributes);
    }
    public function find($account_id)
    {
        return $this->account->query()->find($account_id);
    }
    public function get($query)
    {
        $q = $this->account->query();
        if (isset($query['id'])) {
            $q->where('id', $query['id']);
        }
        if (isset($query['username'])) {
            $q->where('username', 'LIKE', '%' . $query['username'] . '%');
        }
        if (isset($query['account_type'])) {
            $q->where('account_type', $query['account_type']);
        }
        if (isset($query['status'])) {
            $q->where('status', $query['status']);
        }
        if (isset($query['date_from'])) {
            $q->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $query['date_from']));
        }
        if (isset($query['date_to'])) {
            $q->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $query['date_to']));
        }
        return $q->get();
    }

    public function getRolesByUserId($user_id)
    {
        $roles = $this->account->query()->with('roles')->find($user_id);
        return $roles['roles'];
    }

    public function giveRoles($roles,$user_id)
    {
        return $this->account->query()->find($user_id)->assignRole($roles);
    }

    public function syncRoles($roles,$user_id)
    {
        return $this->account->query()->find($user_id)->syncRoles($roles);
    }
}
