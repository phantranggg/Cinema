$('#join-pair').click(function(){
    var scheduleId = ($(this)).attr('data-id');
    var userId1 = $('#user_id1').attr('data-id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        url: "/schedule/join-pair",
        data: {
            schedule_id : scheduleId,
            user_id1 : userId1
        },
        success: function (data) {
            // $('.theater-info-detail').html(data);
        },
        error: function () {
            alert("ERROR");
        }
    });
})