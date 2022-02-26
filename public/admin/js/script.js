let initTooltip = function () {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        html: true,
    })
}

let btnDelete = function () {
    $('.btn-delete').on('click', function () {
        $('.modal-delete .nickname').text($(this).attr('data-name'))
        $('.modal-delete .model').text($(this).attr('data-model'))
        $('.modal-delete form').attr('action', $(this).attr('data-link'))
        $('.modal-delete').modal('show')
    })
}

$(document).ready(function () {
    initTooltip()
    btnDelete()

    // toggle password
    $('.btn-show-password').on('click', function () {
        $(this).toggleClass('fa-eye')
        $(this).toggleClass('fa-eye-slash')
        let newTitle = $(this).attr('data-original-title').toLowerCase() == 'show' ? 'hide' : 'show'
        $(this).tooltip('hide')
            .attr('data-original-title', newTitle)
            .tooltip('show');
        let input = $(this).parent().parent().parent().find('input')
        input.attr('type', input.attr('type') == 'password' ? 'text' : 'password')
    })

    // pushmenu sidebar
    $('.nav-link[data-widget="pushmenu"]').on('click', function () {
        setTimeout(() => {
            if ($('body').hasClass('sidebar-collapse')) {
                document.cookie = "sidebar-collapse=1; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            } else {
                document.cookie = "sidebar-collapse=0; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            }
        }, 100)
    })
})