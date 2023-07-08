@extends('layout.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/orgchart/jquery.orgchart.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">Danh mục sản phẩm</h5>
            </div>
        </div>
        <div class="card-body border-bottom">
            <div id="chart"></div>
        </div>
    </div>

    <div class="modal fade modal-edit-catogory" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="custom-validation create-update-category" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <input type="hidden" name="parent_id">
                        <div class="outer">
                            <div class="mb-2">
                                <label>Tên danh mục :</label>
                                <input type="text" class="form-control" name="name"
                                       data-parsley-required-message="Tên danh mục không được bỏ trống." placeholder="Tên danh mục...">
                            </div>
                            <div class="mb-3">
                                <label>Mô tả :</label>
                                <textarea type="text" class="form-control" name="description"
                                          data-parsley-required-message="Key không được để trống."  placeholder="Mô tả danh mục.."></textarea>
                            </div>
                            <div class="form-check form-switch form-switch-lg">
                                <input class="form-check-input" name="status" type="checkbox" id="category-status">
                                <label class="form-check-label" for="category-status">Trạng thái hoạt động</label>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <label>Slug URL :</label>
                                <input type="text" class="form-control" name="seo_slug" placeholder="Slug để tối ưu URL..." readonly>
                            </div>
                            <div class="mb-2">
                                <label>SEO Title :</label>
                                <input type="text" class="form-control" name="seo_title" placeholder="Nhập tiêu đề SEO...">
                            </div>
                            <div class="mb-2">
                                <label>Meta Description</label>
                                <textarea name="seo_description" class="form-control" placeholder="Mô tả SEO..."></textarea>
                            </div>
                            <div class="inner-repeater mb-4">
                                <button type="submit" class="btn btn-primary submit-update-category" data-bs-dismiss="modal">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/libs/orgchart/jquery.orgchart.js') }}"></script>
    <script src="{{ asset('assets/js/pages/category/category.js') }}"></script>
@endsection
