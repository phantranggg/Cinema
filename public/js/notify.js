$('#mark-read').click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "GET",
        url: "/mark-read",
        success: function (data) {
            $('.unread-noti').css('background-color','white')
        },
        error: function () {
            alert("ERROR");
        }
    });
})

$('.accept-join').click(function () {
    var invitationId = ($(this).attr('data'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        url: "/invitation/accept",
        data: {
            invitation_id: invitationId
        },
        success: function (data) {
            $(".accept-decline-box-" + invitationId).children().toggle();
            console.log("count: " + data);
            if (data-1) {
                $("#noti-count").show();
                $("#noti-count").html(data-1);
            } else {
                $("#noti-count").hide();
            }
            // $(".accept-decline-box-" + invitationId).children().toggle();
        },
        error: function () {
            alert("ERROR");
        }
    });
})

$('.decline-join').click(function () {
    var invitationId = ($(this).attr('data'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        url: "/invitation/decline",
        data: {
            invitation_id: invitationId
        },
        success: function (data) {
            $(".accept-decline-box-" + invitationId).children().toggle();
            // $(".accept-decline-box-" + invitationId).children().toggle();
            if (data-1) {
                $("#noti-count").show();
                $("#noti-count").html(data-1);
            } else {
                $("#noti-count").hide();
            }
        },
        error: function () {
            alert("ERROR");
        }
    });
})