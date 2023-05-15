<?php

namespace App\Http\Controllers\permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\permission\StoreRoleRequest;
use App\Http\Requests\permission\UpdateRoleRequest;
use App\Services\permission\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public $breadcrumb = [];
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->breadcrumb[] = [
            'page' => '/',
            'title' => 'Trang chủ',
        ];

        $this->middleware('permission:update-role')->only(['update']); // cập nhật vai trò
        $this->middleware('permission:create-role')->only(['store']); // tạo mới vai trò
        $this->middleware('permission:delete-role')->only(['destroy']); // xoá vai trò


    }

    public function index()
    {
        $this->breadcrumb[] = [
            'title' => 'Danh sách vai trò'
        ];

        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title' => 'Danh sách vai trò.'
        ];

        return view('pages.roles.index', $data_view);
    }

    public function getListRole(Request $request)
    {
        $query = $request->query();
        $roles = $this->roleService->get($query)->toArray();

        return DataTables::of($roles)->make();
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $attributes = [
            'title' => $request->get('title'),
            'name' => $request->get('name'),
        ];
        $this->roleService->create($attributes);

        return back()->with([
            'message' => 'Tạo mới vai trò thành công.'
        ]);
    }

    public function update(UpdateRoleRequest $request,$role): RedirectResponse
    {
        $attributes = [
          'title'=>$request->get('title'),
          'name'=>$request->get('name'),
        ];

        $this->roleService->update($attributes,$role);

        return back()->with([
            'message'=>'Đã cập nhật thành công',
        ]);
    }
    public function show($name)
    {
        array_push($this->breadcrumb,
            [
                'page' => route('roles.index'),
                'title' => 'Danh sách vai trò'
            ],
            [
                'title' => 'DS quyền thuộc vai trò.'
            ],
        );
        $role = $this->roleService->find($name);

        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title' => 'Danh sách quyền trong vai trò ' . $role['title'],
        ];
        return view('pages.roles.role-rights', $data_view);
    }

    public function getRoleRights(Request $request,$name)
    {
        $query = $request->query();
        $permissions = $this->roleService->getPermissions($query,$name);
        return DataTables::of($permissions)->make();
    }

    public function getPermissions(Request $request, $id)
    {
        $query = $request->query();
        $permissions = $this->roleService->getExistingRights($query, $id);
        return DataTables::of($permissions)->make();
    }

    public function destroy(Request $request): JsonResponse
    {
        $roles = $request->get('roles');
        $this->roleService->destroy($roles);

        return response()->json([
            'status'=>1,
            'message'=>'Đã xoá vai trò!'
        ]);
    }

    public function givePermission(Request $request, $role): JsonResponse
    {
        $permissions = $request->get('permissions');
        $this->roleService->givePermissionTo($permissions, $role);
        return response()->json([
            'message' => 'Đã gán thành công.',
            'status' => 1
        ]);
    }

    public function revokePermission(Request $request,$role): JsonResponse
    {
        $permissions = $request->get('permissions');
        $this->roleService->revokePermissionTo($permissions,$role);
        return response()->json([
            'message'=>'Đã gỡ thành công.',
            'status'=>1
        ]);
    }
}
