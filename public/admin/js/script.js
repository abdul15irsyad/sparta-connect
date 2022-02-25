document.addEventListener('DOMContentLoaded', () => {
    // tooltip
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover focus active',
        html: true,
    })

    // toggle password
    let btnsShowPassword = document.querySelectorAll('.btn-show-password')
    btnsShowPassword.forEach(btn => {
        let input = btn.parentNode.parentNode.parentNode.querySelector('input')
        btn.addEventListener('click', e => {
            e.preventDefault()
            e.target.classList.toggle('fa-eye-slash')
            e.target.classList.toggle('fa-eye')
            input.type = input.type == 'password' ? 'text' : 'password'
            e.target.title = e.target.title == 'show' ? 'hide' : 'show'
        })
    })

    // modal delete
    // $('.modal-delete').on('shown.bs.modal', function (event) {
    //     $('.modal-delete .form-input input').focus();
    // })

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