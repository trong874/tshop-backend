@extends('layout.master')
@section('styles')
    <!-- select2 css -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
{{--@dd($account)--}}
@section('content')
    <form class="custom-validation"
          action="{{  isset($account) ? route('accounts.update',$account['id']) :   route('accounts.store') }}" method="POST">
        @csrf

        @if(isset($account))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-9">
                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Basic Information</h4>
                        <p class="card-title-desc">Fill all information below</p>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Tên tài khoản</label>
                                    <input name="username" type="text" class="form-control"
                                           value="{{ @$account['username'] }}"
                                           required
                                           data-parsley-length="[3,50]"
                                           data-parsley-pattern="\w*$"
                                           data-parsley-required-message="Tên tài khoản không được để trống."
                                           data-parsley-pattern-message="Tên tài khoản không được chứa kí tự và khoảng trắng."
                                           data-parsley-length-message="Tên tài khoản tối thiểu dài 3 ký tự."
                                           placeholder="Nhập tên tài khoản...">
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control"
                                           value="{{ @$account['email'] }}"
                                           required
                                           data-parsley-type="email"
                                           data-parsley-type-message="Địa chỉ email chưa đúng định dạng."
                                           data-parsley-required-message="Địa chỉ emai không được để trống."
                                           placeholder="Địa chỉ email...">
                                </div>

                                @if(!isset($account))
                                    <div class="mb-3">
                                        <label>Mật khẩu</label>
                                        <input name="password" type="text" class="form-control"
                                               required
                                               data-parsley-minlength="6"
                                               data-parsley-required-message="Mật khẩu không được để trống."
                                               data-parsley-minlength-message="Mật khẩu tối thiểu dài 6 ký tự."
                                               placeholder="Mật khẩu...">
                                    </div>
                                    <div class="mb-3">
                                        <label>Nhập lại mật khẩu</label>
                                        <input name="password_confirmation" type="text" class="form-control"
                                               data-parsley-equalto="[name=password]"
                                               required
                                               data-parsley-required-message="Không được để trống."
                                               data-parsley-equalto-message="Mật khẩu nhập lại không khớp."
                                               placeholder="Nhập lại mật khẩu...">
                                    </div>
                                @endif
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        {{ isset($account) ? 'Cập nhật' : 'Tạo tài khoản.' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="control-label">Loại tài khoản</label>
                                    <select class="form-control select2" name="account_type" >
                                        <option value="2" {{ @$account['account_type'] == '2' ? 'selected' : '' }}>Người dùng</option>
                                        <option value="1"  {{ @$account['account_type'] == '1' ? 'selected' : '' }}>Quản trị viên</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Trạng thái hoạt động</label>

                                    <div class="form-check form-switch form-switch-lg mb-3">
                                        <input class="form-check-input" name="status" type="checkbox" {{ @$account['status'] == '1' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <!-- select 2 plugin -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
@endsection
