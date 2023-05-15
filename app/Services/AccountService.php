<?php

namespace App\Services;

use App\Repositories\AccountRepository;
use App\Repositories\permission\RoleRepository;

class AccountService
{
    private $accountRepository;
    private $roleRepository;
    public function __construct(AccountRepository $accountRepository,RoleRepository $roleRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->roleRepository = $roleRepository;
    }

    public function create($attributes)
    {
        return $this->accountRepository->create(array_merge(
            $attributes,
            [
                'password' => bcrypt($attributes['password']),
                'status' => $attributes['status'] ? "1" : "0",
            ]
        ));
    }

    public function update($attributes,$id)
    {
        return $this->accountRepository->update(array_merge(
            $attributes,
            [
                'status' => $attributes['status'] ? "1" : "0",
            ]
        ),
            $id);
    }
    public function get($query)
    {
        return $this->accountRepository->get($query);
    }

    public function find($account_id)
    {
        return $this->accountRepository->find($account_id);
    }

    public function getRolesByUserId($user_id)
    {
        return $this->accountRepository->getRolesByUserId($user_id);
    }

    public function getRolesNotApplyYet($user_id)
    {
        $roles_applied = $this->getRolesByUserId($user_id)->pluck('name');
        $roles = $this->roleRepository->get();
        return $roles->whereNotIn('name',$roles_applied);
    }

    public function giveRoles($roles,$user_id)
    {
        return $this->accountRepository->giveRoles($roles,$user_id);
    }

    public function removeRoles($roles,$user_id)
    {
        $roles_applied = $this->getRolesByUserId($user_id);
        $roles = $roles_applied->whereNotIn('name',$roles)->pluck('name')->toArray();
        return $this->accountRepository->syncRoles($roles,$user_id);
    }
}
