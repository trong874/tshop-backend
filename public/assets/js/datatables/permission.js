$(document).ready(function () {
    const elmRoot = $('html');
    let table = $("#datatable").DataTable(
        {
            responsive: true,
            processing: true,
            serverSide: true,
            destroy: true,
            searching: false,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, 'Tất cả'],
            ],
            order: [ [0, 'desc'] ],
            ajax: {
                url: '/get-list-permission',
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
                    data: 'title',
                    title: 'Tên quyền',
                },
                {
                    data: 'name',
                    title: 'Key quyền',
                },
                {
                    data: 'created_at',
                    title: 'Ngày tạo',
                    render: function (data) {
                        return moment(data).format('DD-MM-YYYY HH:mm:ss')
                    }
                },
                {
                    data: 'id',
                    title: 'Thao tác',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `<ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <button type="button" class="btn btn-sm btn-soft-info edit-permission" data-id="${data}"><i class="mdi mdi-pencil-outline"></i></button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-sm btn-soft-danger delete-permission" data-id="${data}"><i class="mdi mdi-delete-outline"></i></button>
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

        table.ajax.url('/get-list-role?' + query).load();

    }).on('reset', function () {
        table.ajax.url('/get-list-role').load();
    });

    elmRoot.on('click', '.edit-permission', function () {
        const form = $('.modal-update-permission form');
        form.attr('action', '/permissions/' + $(this).data('id'));

        let row = $(this).closest('tr').children();
        let title = row.eq(1).text();
        let name = row.eq(2).text();

        form.find('[name="title"]').val(title)
        form.find('[name="name"]').val(name);

        $('.modal-update-permission').modal('show');
    });

    elmRoot.on('click','.delete-permission',function () {
        $('.modal-delete-permission form').attr('action','/permissions/' + $(this).data('id'))
        $('.modal-delete-permission').modal('show');
    })
});
