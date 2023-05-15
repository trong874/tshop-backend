@extends('layout.master')
@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Danh sách quyền.</h5>
                        <div class="flex-shrink-0">
                            <button type="button"
                                    data-bs-toggle="modal" data-bs-target=".modal-create-permission"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="mdi mdi-plus me-1"></i> Thêm quyền.
                            </button>
                            <a href="" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form id="form-search">
                        <div class="row g-3">
                            <div class="col-6 col-lg-4">
                                <input type="search" class="form-control" name="id" placeholder="Nhập ID ..." autocomplete="off">
                            </div>
                            <div class="col-6 col-lg-4">
                                <input type="search" class="form-control" name="title" placeholder="Tên quyền ...">
                            </div>
                            <div class="col-6 col-lg-4">
                                <input type="search" class="form-control" name="name" placeholder="Key quyền ...">
                            </div>
                            <div class="col-6 col-lg-4">
                                <div id="datepicker1">
                                    <input type="date" class="form-control" name="date_from" placeholder="Từ ngày...">
                                </div><!-- input-group -->
                            </div>
                            <div class="col-6 col-lg-4">
                                <div id="datepicker1">
                                    <input type="date" class="form-control" name="date_to" placeholder="Đến ngày...">
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-6 col-lg-4">
                                <button type="submit" class="btn btn-primary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Tìm kiếm</button>
                            </div>
                            <div class="col-6 col-lg-2">
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
                            <th>Tên quyền</th>
                            <th>Key quyền</th>
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

    <div class="modal fade modal-create-permission" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="custom-validation" action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div class="outer">
                            <div  class="outer">
                                <div class="mb-3">
                                    <label>Tên quyền :</label>
                                    <input type="text" class="form-control"
                                           name="title"
                                           required
                                           data-parsley-required-message="Tên quyền không được bỏ trống."
                                           placeholder="Điền tên quyền...">
                                </div>

                                <div class="mb-3">
                                    <label>Key :</label>
                                    <input type="text" class="form-control"
                                           required
                                           name="name"
                                           data-parsley-pattern="^[a-zA-Z0-9\-]+$"
                                           data-parsley-required-message="Key không được để trống."
                                           data-parsley-pattern-message="Key không được chứa kí tự và khoảng trắng  ( trừ dấu '-' )."
                                           placeholder="Điền key quyền...">
                                </div>

                                <div class="inner-repeater mb-4">
                                    <button  type="submit" class="btn btn-primary inner">Tạo mới</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal create -->
    <div class="modal fade modal-update-permission" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="custom-validation" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="outer">
                            <div  class="outer">
                                <div class="mb-3">
                                    <label>Tên quyền :</label>
                                    <input type="text" class="form-control"
                                           name="title"
                                           required
                                           data-parsley-required-message="Tên quyền không được bỏ trống."
                                           placeholder="Điền tên quyền...">
                                </div>

                                <div class="mb-3">
                                    <label>Key :</label>
                                    <input type="text" class="form-control"
                                           required
                                           name="name"
                                           data-parsley-pattern="^[a-zA-Z0-9\-]+$"
                                           data-parsley-required-message="Key không được để trống."
                                           data-parsley-pattern-message="Key không được chứa kí tự và khoảng trắng  ( trừ dấu '-' )."
                                           placeholder="Điền key quyền...">
                                </div>

                                <div class="inner-repeater mb-4">
                                    <button  type="submit" class="btn btn-primary inner">Chỉnh sửa</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal update-->
    <div class="modal fade modal-delete-permission" tabindex="-1"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sau khi xoá sẽ không thể hoàn tác, quyền đã được gán trong vai trò cũng sẽ bị xoá theo. Xác nhận xoá?.</p>
                </div>
                <div class="modal-footer">
                    <!-- Toogle to second dialog -->
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ asset('assets/js/datatables/permission.js') }}"></script>

    <!-- select 2 plugin -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- ValidateForm -->
    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
@endsection
