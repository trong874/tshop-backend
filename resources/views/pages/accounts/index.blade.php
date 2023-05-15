{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
    <!-- select2 css -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>

@endsection
{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Danh sách tài khoản</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('accounts.create') }}"
                               class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                    class="mdi mdi-plus me-1"></i> Tạo tài khoản.
                            </a>
                            <a href="" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form id="form-search">
                        <div class="row g-3">
                            <div class="col-xxl-3 col-lg-6">
                                <input type="search" class="form-control" name="id" placeholder="Nhập ID ..." autocomplete="off">
                            </div>
                            <div class="col-xxl-3 col-lg-6">
                                <input type="search" class="form-control" name="username" placeholder="Tên tài khoản ...">
                            </div>
                            <div class="col-xxl-3 col-lg-6">
                                <select class="form-control select2" name="account_type"  data-placeholder="Loại tài khoản..." data-close="true">
                                    <option></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Người dùng</option>
                                </select>
                            </div>
                            <div class="col-xxl-3 col-lg-4">
                                <select class="form-control select2" name="status" data-placeholder="Trạng thái..." data-close="true">
                                    <option></option>
                                    <option value="0">Bị khoá</option>
                                    <option value="1">Đang hoạt động</option>
                                </select>
                            </div>
                            <div class="col-xxl-3 col-lg-4">
                                <div id="datepicker1">
                                    <input type="date" class="form-control" name="date_from" placeholder="Từ ngày...">
                                </div><!-- input-group -->
                            </div>
                            <div class="col-xxl-3 col-lg-4">
                                <div id="datepicker1">
                                    <input type="date" class="form-control" name="date_to" placeholder="Đến ngày...">
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-xxl-3 col-lg-4">
                                <button type="submit" class="btn btn-primary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Tìm kiếm</button>
                            </div>
                            <div class="col-2">
                                <button type="reset" class="btn btn-soft-secondary w-100"><i class="mdi mdi-refresh align-middle"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Avatar</th>
                            <th>Loại tài khoản</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/dataTables.dateTime.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/datatables/account-list.js') }}"></script>

    <!-- select 2 plugin -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
@endsection
