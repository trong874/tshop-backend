$(document).ready(function () {
    const  elmRoot = $('html');
    elmRoot.on('change', '.group-checkable', function () {
        let set = $(this).closest('table').find('td:first-child .form-check-input');
        let checked = $(this).is(':checked');

        $(set).each(function () {
            $(this).prop('checked', checked);
            $(this).closest('tr').toggleClass('active', checked);
        });
    }).on('change', 'tbody tr .form-check-input', function () {
        $(this).parents('tr').toggleClass('active');
    });

    $(".select2").each(function (i, elm) {
        const placeholder = $(elm).data('placeholder');
        const allowClear = $(elm).data('close') === true;
        $(elm).select2({
            placeholder: placeholder ?? '',
            allowClear: allowClear
        })
    });

})
