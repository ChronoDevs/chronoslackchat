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


// To toggle channels and direct messages visibility in dashboard
$(document).ready(function () {
    $('#channel-list').show();
    $('#add-channels').show();
    $('#direct-message-list').show();
    $('#add-coworkers').show();

    // Channels toggle
    $('#toggle-channels').on('click', function () {
        $('#channel-down-icon-toggle').toggleClass('bi-caret-down-fill bi-caret-left-fill');
        $('#dashboard-channels').toggleClass('flex-grow-1');
        $('#channel-list').toggle();
        $('#channel-list').toggleClass('d-flex flex-grow-1');
        $('#add-channels').toggle();

        // Check if the channel list is hidden
        if ($('#channel-list').is(':hidden')) {
            // Add the css class of overriding the overflow max height
            $('#overflow-direct-message').addClass('extend-overflow-maxheight');
        } else {
            $('#overflow-direct-message').removeClass('extend-overflow-maxheight');
        }
    });

    // Direct Messages toggle
    $('#toggle-direct-messages').on('click', function () {
        $('#direct-down-icon-toggle').toggleClass('bi-caret-down-fill bi-caret-left-fill');
        $('#dashboard-direct-messages').toggleClass('flex-grow-1');
        $('#direct-message-list').toggle();
        $('#direct-message-list').toggleClass('d-flex flex-grow-1');
        $('#add-coworkers').toggle();

        // Check if the direct message list is hidden
        if ($('#direct-message-list').is(':hidden')) {
            // Add the css class of overriding the overflow max height
            $('#overflow-channel').addClass('extend-overflow-maxheight');
        } else {
            $('#overflow-channel').removeClass('extend-overflow-maxheight');
        }
    });
});
