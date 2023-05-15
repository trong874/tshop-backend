<?php

namespace App\Http\Controllers\permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\permission\StorePermissionRequest;
use App\Http\Requests\permission\UpdatePermissionRequest;
use App\Services\permission\PermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public $breadcrumb = [];
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
        $this->breadcrumb[] = [
            'page' => '/',
            'title' => 'Trang chủ',
        ];

        $this->middleware('permission:update-permission')->only(['update']); // cập nhật quyền
        $this->middleware('permission:create-permission')->only(['store']); //tạo mới quyền
        $this->middleware('permission:delete-permission')->only(['destroy']); // xoá quyền
    }

    public function index()
    {
        $this->breadcrumb[] = [
            'title' => 'Danh sách quyền'
        ];

        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title' => 'Danh sách quyền.'
        ];

        return view('pages.permissions.index', $data_view);
    }

    public function getListPermission(Request $request)
    {
        $query = $request->query();
        $permissions = $this->permissionService->get($query)->toArray();

        return DataTables::of($permissions)->make();
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $attributes = [
            'title'=>$request->get('title'),
            'name'=>$request->get('name'),
        ];
        $this->permissionService->create($attributes);

        return back()->with([
            'message'=>'Tạo mới quyền thành công.'
        ]);
    }

    public function update(UpdatePermissionRequest $request,$id): RedirectResponse
    {
        $attributes = [
            'title'=>$request->get('title'),
            'name'=>$request->get('name'),
        ];
        $this->permissionService->update($attributes,$id);

        return back()->with([
            'message'=>'Cập nhật thông tin quyền thành công.'
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $this->permissionService->destroy($id);

        return back()->with([
            'message'=>'Đã xoá quyền thành công.'
        ]);
    }
}
