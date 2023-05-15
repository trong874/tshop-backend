<?php

namespace App\Http\Controllers;

use App\Http\Requests\account\StoreAccountRequest;
use App\Http\Requests\account\UpdateAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    public $breadcrumb = [];
    protected $accountService;
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
        $this->breadcrumb[] = [
            'page'=>'/',
            'title'=>'Trang chủ',
        ];

        $this->middleware('permission:update-user')->only(['edit','update']); // cập nhật tài khoản
        $this->middleware('permission:create-user')->only(['create','store']); // tạo mới tài khoản

        $this->middleware('permission:attach-role-user')->only(['show']); // gán vai trò cho user

    }

    public function index()
    {
        $this->breadcrumb[] = [
            'title'=>'Danh sách tài khoản',
        ];
        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title'=>'Danh sách tài khoản hệ thống.'
        ];
        return view('pages.accounts.index',$data_view);
    }

    public function getListAccount(Request $request)
    {
        $query = $request->query();
        $accounts = $this->accountService->get($query)->toArray();
        return DataTables::of($accounts)->make();
    }
    public function create()
    {
        array_push($this->breadcrumb,
            [
                'page'=>'/accounts',
                'title'=>'Danh sách tài khoản',
            ],
            [
                'title'=>'Tạo mới tài khoản',
            ]
        );
        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title'=>'Tạo mới tài khoản.'
        ];
        return view('pages.accounts.create_edit',$data_view);
    }
    public function store(StoreAccountRequest $request)
    {
        $this->accountService->create($request->all());

        return back()->with([
            'message'=>'Tạo mới tài khoản thành công.'
        ]);
    }

    public function show($id)
    {
        array_push($this->breadcrumb,
            [
                'page'=>'/accounts',
                'title'=>'Danh sách tài khoản',
            ],
            [
                'title'=>'Quyền tài khoản',
            ]
        );
        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title'=>'Quyền tài khoản.'
        ];
        return view('pages.accounts.role_user',$data_view);
    }

    public function getRoleUser(Request $request,$user_id)
    {
        $roles = $this->accountService->getRolesByUserId($user_id);
        return DataTables::of($roles)->make();
    }

    public function getRoleNotApply(Request $request, $user_id)
    {
        $roles = $this->accountService->getRolesNotApplyYet($user_id);
        return DataTables::of($roles)->make();
    }

    public function giveRole(Request $request,$user_id)
    {
        $roles = $request->get('roles');
        $this->accountService->giveRoles($roles,$user_id);

        return response()->json([
           'status'=>1,
           'message'=> 'Đã gán vai trò thành công.'
        ]);
    }

    public function removeRoles(Request $request,$user_id)
    {
        $roles = $request->get('roles');
        $this->accountService->removeRoles($roles,$user_id);

        return response()->json([
            'status'=>1,
            'message'=>'Đã gỡ vai trò khỏi tài khoản.'
        ]);
    }
    public function edit($id)
    {
        array_push($this->breadcrumb,
            [
                'page'=>'/accounts',
                'title'=>'Danh sách tài khoản',
            ],
            [
                'title'=>'Cập nhật thông tin',
            ]
        );

        $account = $this->accountService->find($id)->toArray();
        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title'=>'Cập nhật thông tin.',
            'account'=>$account,
        ];
        return view('pages.accounts.create_edit',$data_view);
    }

    public function update(UpdateAccountRequest $request, $id): RedirectResponse
    {
        $attributes=  [
            'username'=>$request->get('username'),
            'email'=>$request->get('email'),
            'account_type'=>$request->get('account_type'),
            'status'=>$request->get('status'),
        ];

        $this->accountService->update($attributes,$id);

        return back()->with([
            'message'=>'Đã cập nhật thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
