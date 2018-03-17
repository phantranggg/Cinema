$('.delete-button-movie').click(function() {
    var movieId = $(this).attr('movieId');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/admin/movies/delete",
            data: {
                movie_id: movieId
            },
            success: function () {
                //alert("SUCCESS");
                var tmp = '#movie-row-' + movieId;
                $(tmp).hide();
            },
            error: function () {
                alert("FAIL");
            }
        });
});

$('.delete-button-user').click(function() {
    var userId = $(this).attr('userId');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/admin/users/delete",
            data: {
                user_id: userId
            },
            success: function () {
                //alert("SUCCESS");
                var tmp = '#user-row-' + userId;
                $(tmp).hide();
            },
            error: function () {
                alert("FAIL");
            }
        });
});