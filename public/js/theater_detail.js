$('.theater-name').click(function () {
    var theaterId = ($(this).attr('data-id'));
    var movieId = $('.schedule').attr('data-id1');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/theater/detail",
        data: {
            theater_id: theaterId
        },
        success: function (data) {
            $('.theater-info-detail').html(data);
        },
        error: function () {
            alert("ERROR");
        }
    });

    if (movieId == null) {
        $.ajax({
            method: "POST",
            url: "/theater/schedule",
            data: {
                theater_id: theaterId
            },
            success: function (data) {
                $('.schedule').html(data);
            },
            error: function () {
                alert("ERROR");
            }
        });
    } else {
    console.log(movieId);
        $.ajax({
            method: "POST",
            url: "/theater/schedule-movie",
            data: {
                theater_id: theaterId,
                movie_id: movieId,
            },
            success: function (data) {
                $('.schedule').html(data);
            },
            error: function () {
                alert("ERROR");
            }
        });
    }
})