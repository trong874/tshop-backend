<?php

namespace App\Services\permission;

use App\Repositories\permission\RoleRepository;

class RoleService
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create($attributes)
    {
        return $this->roleRepository->create($attributes);
    }

    public function update($attributes,$role)
    {
        $this->roleRepository->update($attributes,$role);
    }
    public function destroy($role): ?bool
    {
        return $this->roleRepository->destroy($role);
    }
    public function get($query)
    {
        return $this->roleRepository->get($query);
    }

    public function find($name)
    {
        return $this->roleRepository->find($name);
    }

    public function getPermissions($query,$name)
    {
        $role = $this->roleRepository->getPermissions($query,$name)->toArray();
        return $role['permissions'];
    }

    public function getExistingRights($query,$name)
    {
        $role = $this->roleRepository->getPermissions([],$name);
        $existing_rights = $role['permissions']->pluck('id')->toArray();
        $guard_name = $role['guard_name'];
        return $this->roleRepository->getExistingRights($query,$existing_rights,$guard_name)->toArray();
    }

    public function givePermissionTo($permissions,$role)
    {
        return $this->roleRepository->givePermissionTo($permissions,$role);
    }

    public function revokePermissionTo($permissions,$role)
    {
        return $this->roleRepository->revokePermissionTo($permissions,$role);
    }
}
