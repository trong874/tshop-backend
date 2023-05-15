<?php

namespace App\Services\permission;

use App\Repositories\permission\PermissionRepository;

class PermissionService
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function create($attributes)
    {
        return $this->permissionRepository->create($attributes);
    }
    public function update($attributes,$id)
    {
        return $this->permissionRepository->update($attributes,$id);
    }

    public function destroy($id)
    {
        return $this->permissionRepository->destroy($id);
    }
    public function get($query)
    {
        return $this->permissionRepository->get($query);
    }
}
