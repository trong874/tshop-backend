<?php

namespace App\Repositories\permission;

use Carbon\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    private $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function create($attributes)
    {
        return $this->permission->create($attributes);
    }

    public function update($attributes,$id)
    {
        return $this->permission->findOrFail($id)->update($attributes);
    }

    public function destroy($id)
    {
        return $this->permission->destroy($id);
    }
    public function get($query)
    {
        $q = $this->permission->query();
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
}
