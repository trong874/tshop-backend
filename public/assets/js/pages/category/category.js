$(document).ready(function () {
    const csrf_token = $('meta[name="csrf-token"]').attr('content');

    let chart;
    
    $.ajax({
        url:'/get-categories',
        type:'GET',
        success: res => {
            if (!res.error) {
                let data = res.data;
                chart = $('#chart').orgChart({
                    data: data,
                    showControls: true,
                    allowEdit: true,
                    onAddNode: function (node) {
                        chart.newNode(node.data.id);
                    },
                    onDeleteNode: function (node) {
                        if ( confirm('Xác nhận xoá danh mục?') ) {
                            deleteCategory(node.data.id);
                        }
                    },
                });
            }
        }
    })

    function deleteCategory(id) {
        $.ajax({
            url:'/categories/'+ id,
            type:'DELETE',
            data: {
                _token: csrf_token,
            },
            success: res => {
                if (!res.error) {
                    chart.deleteNode(id);
                    toastr.success(res.message);
                }
            }
        })
    }
    $('.submit-save').on('click', function () {
        if (!chart) {
            alert('Chưa tải xong dữ liệu...')
            return;
        }
        let data = chart.getData();
        data.shift() //Xoá phần từ đầu tiên (rootNode);
        $.ajax({
            url:'/categories/',
            type:'POST',
            data: {
                _token: csrf_token,
                data: data,
            },
            success: res => {
                if(!res.error) {
                    toastr.success(res.message);
                }
            }
        })
    })

    $('input[name="name"]').on('input', function () {
        const slug = convertToSlug($(this).val().trim());

        $('input[name="seo_slug"]').val(slug);
    });

    $('form.create-update-category').on('submit',function (e){
        e.preventDefault();
        let url = $(this).attr('action');
        let dataForm = $(this).serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        dataForm.status = dataForm.status ? 1 : 0;

        $.ajax({
            url: url,
            type:'POST',
            data: dataForm,
            success: res => {
                if(!res.error) {
                    toastr.success(res.message);
                }
            }
        })
    })
});
