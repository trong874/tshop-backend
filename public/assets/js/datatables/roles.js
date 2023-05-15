$(document).ready(function () {
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const elmRoot = $('html');

    let table = $("#datatable").DataTable(
        {
            initComplete: function () {
                $('#datatable_wrapper .row').eq(0).children().eq(1).html(`
                    <button type="button"
                    class="btn btn-danger waves-effect waves-light float-end delete-roles">
                        <i class="bx bx-trash font-size-16 align-middle me-2"></i> Xoá đã chọn
                    </button>
                `)
            },
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            searching:false,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, 'Tất cả'],
            ],
            order: [ [0, 'desc'] ],
            ajax: {
                url: '/get-list-role',
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
                    data: 'created_at',
                    title: 'Ngày tạo',
                    render:function (data) {
                        return moment(data).format('DD-MM-YYYY HH:mm:ss')
                    }
                },
                {
                    data:'name',
                    title: 'Thao tác',
                    orderable: false,
                    searchable: false,
                    render: function (data,type,row) {
                        return `<ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <a href="/roles/${data}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-sm btn-soft-info edit-role" data-name="${data}"><i class="mdi mdi-pencil-outline"></i></button>
                                        </li>
                                        <li>
                                        <button type="button" class="btn btn-sm btn-soft-danger delete-role"
                                        data-bs-toggle="modal"
                                        data-bs-target=".modal-delete-role"
                                        data-name="${data}">
                                            <i class="mdi mdi-delete-outline"></i>
                                        </button>
                                        </li>
                                    </ul>`;
                    }
                }
            ],
        }
    )

    $('#form-search').on('submit',function (e){
        e.preventDefault();
        const data = $(this).serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {})

        let query = '';
        Object.keys(data).forEach(function(key) {
            if (data[key]) {
                query += (query ? `&` :  '') + `${key}=${data[key]}`;
            }
        });

        table.ajax.url('/get-list-role?'+ query).load();

    }).on('reset',function (){
        table.ajax.url('/get-list-role').load();
    })

    let destroy_roles = [];
    elmRoot.on('click','.delete-role',function () {
        destroy_roles = [ $(this).data('name') ];
    })
    elmRoot.on('click','.delete-roles',function () {
        destroy_roles = [];
        let checked = $('#datatable .select-role:checked');
        if (!checked.length) {
            alert('Chưa chọn vai trò nào!');
            return;
        }
        checked.each(function (index, input) {
            destroy_roles.push( $(input).val() )
        });

        $('.modal-delete-role').modal('show');
    })

    elmRoot.on('click', '.edit-role', function () {
        const form = $('.modal-update-role form');
        form.attr('action', '/roles/' + $(this).data('name'));

        let row = $(this).closest('tr').children();
        let title = row.eq(2).text();
        let name = row.eq(3).text();

        form.find('[name="title"]').val(title)
        form.find('[name="name"]').val(name);

        $('.modal-update-role').modal('show');
    });

    $('.submit-delete-roles').on('click',function () {
        $.ajax({
            url:'/destroy-roles',
            type:'POST',
            data: {
                _token:csrf_token,
                roles:destroy_roles,
            },
            success: res => {
                if (res.status === 1 ){
                    toastr.success(res.message);
                    table.ajax.url('/get-list-role').load();
                }
            }
        })
    })
});
