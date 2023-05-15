$(document).ready(function () {
    let table = $("#datatable").DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            searching:false,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, 'Tất cả'],
            ],

            ajax: {
                url: '/get-list-account',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                }
            },
            language: {
                url: '/assets/js/datatables/i18n/vietnam.json',
            },
            columns: [
                {
                    data: 'id',
                    title: 'ID'
                },
                {
                    data: 'username',
                    title: 'Tên tài khoản',
                },
                {
                    data: 'image',
                    title: 'Avatar',
                    render: function (data, type, row) {
                        return `<img src="${data || '/assets/images/users/user-placeholder.png'}" alt="" class="rounded avatar-sm">`
                    }
                },
                {
                    data: 'account_type',
                    title: 'Loại tài khoản',
                    render: function (data) {
                        return data === "1"
                            ? '<span class="badge rounded-pill bg-warning font-size-12 fw-bold">Admin</span>'
                            : '<span class="badge rounded-pill bg-success font-size-12 fw-bold">Người dùng</span>'
                    }
                },
                {
                    data: 'status',
                    title: 'Trạng thái',
                    orderable: false,
                    render: function (data) {
                        return data === "0"
                            ? '<span class="badge badge-pill badge-soft-danger font-size-12 fw-bolder">Đã khoá</span>'
                            : '<span class="badge badge-pill badge-soft-success font-size-12 fw-bolder">Đang hoạt động</span>'
                    }
                },
                {
                    data: 'created_at',
                    title: 'Ngày tạo',
                    render:function (data) {
                        return moment(data).format('DD-MM-YYYY HH:mm:ss')
                    }
                },
                {
                    data:'id',
                    title: 'Thao tác',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `<ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <a href="/accounts/${data}/edit" class="btn btn-sm btn-outline-success font-size-14" title="Sửa thông tin"><i class="mdi mdi-account-edit-outline"></i></a>
                                        </li>
                                        <li>
                                            <a href="/accounts/${data}" class="btn btn-sm btn-outline-primary font-size-14 show-roles-user"  title="Quyền hạn user">
                                                <i class="mdi mdi-account-key"></i>
                                             </a>
                                        </li>
                                    </ul>`
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

        table.ajax.url('/get-list-account?'+ query).load();

    }).on('reset',function (){
        table.ajax.url('/get-list-account').load();
        //reset select2
        $('.select2').val(null).trigger("change")
    });
});
