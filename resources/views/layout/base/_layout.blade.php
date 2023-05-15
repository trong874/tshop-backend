<div id="layout-wrapper">
    @include('layout.base._header')
    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">
        <div class="px-2">
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" id="input-filter-aside" placeholder="Tìm kiếm...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>
        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            @if(config('layout.aside.self.display'))
                @include('layout.base._aside')
            @endif
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $page_title ?? 'TShop Backend' }}</h4>

                            <!-- breadcrumb -->
                            @include('layout.base._breadcrumb')

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @yield('content')
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('layout.base._footer')

    </div>
    <!-- end main content-->

</div>

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="{{ asset('assets/images/layouts/layout-1.jpg') }}" class="img-thumbnail" alt="layout images">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="{{ asset('assets/images/layouts/layout-2.jpg') }}" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>
        </div>
    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
