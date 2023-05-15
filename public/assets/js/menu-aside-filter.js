$(document).ready(function (){
    $('#input-filter-aside').on('input',function (){
        const keyword = convertToSlug(this.value);
        const items = $('#side-menu li:not(.menu-title)');

        items.each(function (index,item) {
            const text = convertToSlug( $(item).text() );
            const condition = text.indexOf(keyword) > -1;
            $(item).toggle(condition);

            $(item).prevAll('.menu-title').first().toggle(condition)
        })

    })
})
