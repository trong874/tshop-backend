$(document).ready(function () {
    const userId = $('#user-id').val();
    const elmRoot = $('html');
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    let table = $("#datatable").DataTable(
        {
            initComplete: function () {
                $('#datatable_wrapper .row').eq(0).children().eq(1).html(`
                    <button type="button"
                    class="btn btn-danger waves-effect waves-light float-end remove-roles">
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
                url: '/get-role-user/' + userId,
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
                            <input class="form-check-input select-role" type="checkbox" value="${data}">
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
                                             data-bs-target=".modal-remove-roles"
                                             class="btn btn-sm btn-soft-danger remove-role" data-name="${data}"><i class="mdi mdi-delete-outline"></i></button>
                                        </li>
                                    </ul>`;
                    }
                }
            ],
        }
    )
    let table_role = $("#datatable-role").DataTable(
        {
            initComplete: function () {
                $('#datatable-role_wrapper .row').eq(0).children().eq(1).html(`
                    <button type="button"
                    class="btn btn-primary waves-effect waves-light float-end giveRoles">
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
                [10, 25, 50, -1],
                [10, 25, 50, 'Tất cả'],
            ],
            order: [[1, 'desc']],
            ajax: {
                url: '/get-user-role-not-apply/' + userId,
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
                            <input class="form-check-input select-role" type="checkbox" value="${data}">
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
                                             class="btn btn-sm btn-soft-primary giveRole"
                                             data-name="${data}">
                                                    <i class="mdi mdi-import"></i>
                                             </button>
                                        </li>
                                    </ul>`;
                    }
                }
            ],
        }
    )

    elmRoot.on('click','.giveRole',function () {
        giveRole( [ $(this).data('name') ] )
    })

    elmRoot.on('click','.giveRoles',function () {
        let roles = [];
        let checked = $('#datatable-role input.select-role:checked');
        if (!checked.length) {
            alert('Chưa chọn vai trò nào!');
            return;
        }
        checked.each(function (index,input){
            roles.push( $(input).val() )
        })
        giveRole(roles)
    })

    function giveRole(roles) {
        $.ajax({
            url:'/give-role-user/' + userId,
            type:'POST',
            data: {
                _token: csrf_token,
                roles: roles
            },
            success: res => {
                if (res.status === 1){
                    toastr.success(res.message);
                    table.ajax.reload();
                    $('.modal.show').modal('hide');
                }
            }
        })
    }
    $('.modal-assign-role').on('shown.bs.modal',function () {
        table_role.ajax.reload();
    })
    let roles_remove = [];

    elmRoot.on('click','.remove-role',function () {
        roles_remove = [ $(this).data('name') ];
    });

    elmRoot.on('click','.remove-roles',function () {
        roles_remove = [];
        let checked = $('#datatable input.select-role:checked');
        if (!checked.length) {
            alert('Chưa chọn vai trò nào!');
            return;
        }
        checked.each(function (index,input){
            roles_remove.push( $(input).val() )
        })
        $('.modal-remove-roles').modal('show');
    });


    $('.submit-remove').on('click',function () {
        $.ajax ({
            url:'/remove-roles/' + userId,
            type:'POST',
            data: {
                _token: csrf_token,
                roles : roles_remove,
            },
            success: res => {
                if (res.status === 1){
                    toastr.success(res.message);
                    table.ajax.reload();
                }
            }
        })
    })
})
