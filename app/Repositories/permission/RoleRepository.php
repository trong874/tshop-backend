<?php

namespace App\Repositories\permission;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
class RoleRepository
{
    private $role;
    private $permission;
    public function __construct(Role $role,Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function create($attributes)
    {
        return $this->role->create($attributes);
    }

    public function update($attributes,$role)
    {
        $this->role->findByName($role)->update($attributes);
    }
    public function destroy($role): ?bool
    {
        return $this->role->query()->whereIn('name',$role)->delete();
    }
    public function get($query = [])
    {
        $q = $this->role->query();
        if (isset($query['id'])) {
            $q->where('id', $query['id']);
        }
        if (isset($query['name'])) {
            $q->where('name', 'LIKE', '%' . $query['name'] . '%');
        }
        if (isset($query['title'])) {
            $q->where('title','LIKE', '%' . $query['title'] . '%');
        }
        if (isset($query['date_from'])) {
            $q->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $query['date_from']));
        }
        if (isset($query['date_to'])) {
            $q->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $query['date_to']));
        }
        return $q->get();
    }

    public function find($name)
    {
        return $this->role->findByName($name);
    }

    public function getPermissions($query,$name)
    {
        return $this->role->with(['permissions'=>function($relation) use ($query) {
            if (isset($query['id'])) {
                $relation->where('id',$query['id']);
            }
            if (isset($query['title'])) {
                $relation->where('title','LIKE','%'.$query['title'].'%');
            }
            if (isset($query['name'])) {
                $relation->where('name','LIKE','%'.$query['name'].'%');
            }
        }])->where('name',$name)->first();
    }

    public function getExistingRights($query,$existing_rights,$guard_name)
    {
        $relation =  $this->permission->query();
        $relation->where('guard_name',$guard_name);
        if (isset($query['id'])) {
            $relation->where('id',$query['id']);
        }
        if (isset($query['title'])) {
            $relation->where('title','LIKE','%'.$query['title'].'%');
        }
        if (isset($query['name'])) {
            $relation->where('name','LIKE','%'.$query['name'].'%');
        }

        return $relation->whereNotIn('id',$existing_rights)->get();
    }

    public function givePermissionTo($permissions,$role)
    {
        return $this->role->findByName($role)->givePermissionTo($permissions);
    }

    public function revokePermissionTo($permisisons,$role)
    {
        return $this->role->findByName($role)->revokePermissionTo($permisisons);
    }
}
