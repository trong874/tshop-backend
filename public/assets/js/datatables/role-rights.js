$(document).ready(function () {
    const roleName = $('#role-name').val();
    const elmRoot = $('html');
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    let table = $("#datatable").DataTable(
        {
            initComplete: function () {
                $('#datatable_wrapper .row').eq(0).children().eq(1).html(`
                    <button type="button"
                    class="btn btn-danger waves-effect waves-light float-end detach-permissions">
                        <i class="bx bx-trash font-size-16 align-middle me-2"></i> Xoá đã chọn
                    </button>
                `)
            },
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            searching: false,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'Tất cả'],
            ],
            order: [[1, 'desc']],
            ajax: {
                url: '/get-role-rights/' + roleName,
                type: 'POST',
                data: {
                    _token: csrf_token,
                }
            },
            language: {
                url: '/assets/js/datatables/i18n/vietnam.json',
            },
            headerCallback: function (thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                   <div class="form-check font-size-16 align-middle">
                        <input class="form-check-input group-checkable" type="checkbox">
                        <label class="form-check-label"></label>
                    </div>`;
            },
            columns: [
                {
                    data: 'name',
                    width: '30px',
                    orderable: false,
                    render: function (data) {
                        return `
                        <div class="form-check font-size-16 align-middle">
                            <input class="form-check-input select-permission" type="checkbox" value="${data}">
                            <label class="form-check-label"></label>
                        </div>`;
                    },
                },
                {
                    data: 'id',
                    title: 'ID'
                },
                {
                    data: 'title',
                    title: 'Tên vai trò',
                },
                {
                    data: 'name',
                    title: 'Key vai trò',
                },
                {
                    data: 'name',
                    title: 'Thao tác',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `<ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <button type="button"
                                             data-bs-toggle="modal"
                                             data-bs-target=".modal-detach-permission"
                                             class="btn btn-sm btn-soft-danger detach-permission" data-name="${data}"><i class="mdi mdi-delete-outline"></i></button>
                                        </li>
                                    </ul>`;
                    }
                }
            ],
        }
    )


    let table_existing_rights = $('#datatable-existing-rights').DataTable(
        {
            initComplete: function () {
                $('#datatable-existing-rights_wrapper .row').eq(0).children().eq(1).html(`
                    <button type="button"
                    class="btn btn-primary waves-effect waves-light float-end give-multi-permission">
                        <i class="bx bx-import font-size-16 align-middle me-2"></i> Gán đã chọn
                    </button>
                `)
            },
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            searching: false,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, 'Tất cả'],
            ],
            order: [[1, 'desc']],
            ajax: {
                url: '/get-new-permission/' + roleName,
                type: 'POST',
                data: {
                    _token: csrf_token,
                }
            },
            language: {
                url: '/assets/js/datatables/i18n/vietnam.json',
            },
            headerCallback: function (thead) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                   <div class="form-check font-size-16 align-middle">
                        <input class="form-check-input group-checkable" type="checkbox">
                        <label class="form-check-label"></label>
                    </div>`;
            },
            columns: [
                {
                    data: 'name',
                    width: '30px',
                    orderable: false,
                    render: function (data) {
                        return `
                        <div class="form-check font-size-16 align-middle">
                            <input class="form-check-input select-permission" type="checkbox" value="${data}">
                            <label class="form-check-label"></label>
                        </div>`;
                    },
                },
                {
                    data: 'id',
                    title: 'ID'
                },
                {
                    data: 'title',
                    title: 'Tên vai trò',
                },
                {
                    data: 'name',
                    title: 'Key vai trò',
                },
                {
                    data: 'name',
                    title: 'Thao tác',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `<ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <button type="button" class="btn btn-sm btn-soft-primary give-permission" data-name="${data}"><i class="mdi mdi-import"></i></button>
                                        </li>
                                    </ul>`;
                    }
                }
            ],
        }
    )



    $('#form-search').on('submit', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {})

        let query = '';
        Object.keys(data).forEach(function (key) {
            if (data[key]) {
                query += (query ? `&` : '') + `${key}=${data[key]}`;
            }
        });

        table.ajax.url(`/get-role-rights/${roleName}?${query}`).load();

    }).on('reset', function () {
        table.ajax.url('/get-role-rights/' + roleName).load();
    });

    $('#form-search-existing-rights').on('submit', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {})

        let query = '';
        Object.keys(data).forEach(function (key) {
            if (data[key]) {
                query += (query ? `&` : '') + `${key}=${data[key]}`;
            }
        });
        table_existing_rights.ajax.url(`/get-new-permission/${roleName}?${query}`).load();
    }).on('reset', function () {
        table_existing_rights.ajax.url('/get-new-permission/' + roleName).load();
    });
    $('.modal-attach-permission').on('shown.bs.modal', function () {
        table_existing_rights.ajax.url('/get-new-permission/' + roleName).load();
    })

    elmRoot.on('click', '.give-permission', function () {
        givePermission([$(this).data('name')])
    });
    elmRoot.on('click', '.give-multi-permission', function () {
        let permissions = [];
        let checked = $('#datatable-existing-rights input.select-permission:checked');
        checked.each(function (index,input){
            permissions.push( $(input).val() )
        })
        givePermission(permissions)
    });

    function givePermission(permissions) {
        $.ajax({
            url: `/give-permission/${roleName}`,
            type: 'POST',
            data: {
                _token: csrf_token,
                permissions: permissions,
            },
            success: res => {
                if(res.status === 1) {
                    toastr.success(res.message);
                    table.ajax.url('/get-role-rights/' + roleName).load();
                    $('.modal').modal('hide')
                }
            }
        })
    }

    let permissions = [];

    elmRoot.on('click', '.detach-permission', function () {
        permissions = $(this).data('name');
    })
    elmRoot.on('click', '.detach-permissions', function (e) {
        permissions = [];
        let checked = $('#datatable .select-permission:checked');
        if (!checked.length) {
            e.preventDefault();
            alert('Chưa chọn quyền nào!');
            return;
        }
        checked.each(function(index,input){
            permissions.push( $(input).val() )
        });

        $('.modal-detach-permission').modal('show')
    })

    $('.submit-detach').on('click', function () {
        $.ajax({
            url: '/revoke-permission/' + roleName,
            type: "POST",
            data: {
                _token: csrf_token,
                permissions: permissions,
            },
            success: res => {
                if (res.status === 1) {
                    toastr.success(res.message);
                    table.ajax.url('/get-role-rights/' + roleName).load();
                }
            }
        })
    })
});
