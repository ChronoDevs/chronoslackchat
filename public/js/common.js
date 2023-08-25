// To toggle password visibility
$(document).ready(function () {
    $('#show-password-toggle').on('click', function() {
        var type = $('input[name=password]').attr('type');
        if (type == 'password') {
            $('input[name=password]').attr('type', 'text');
        } else {
            $('input[name=password]').attr('type', 'password');
        }
        $(this).toggleClass('bi-eye bi-eye-slash');
    });
});
