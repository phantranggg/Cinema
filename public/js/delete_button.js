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
    var userId = $(this).attr('userid');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "GET",
            url: "/admin/user/destroy/",
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

$(document).on("click", ".deactivate-button-user", function() {
    console.log("Click1");
    var userId = $(this).attr('userId');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/admin/users/deactivate",
            data: {
                user_id: userId
            },
            success: function () {
                //alert("SUCCESS");
                var tmp = '#user-row-' + userId;
                $(tmp + " td span").replaceWith('<span class="label label-danger">Deactivated</span>');
                $(tmp + " .deactivate-button-user").replaceWith('<button class="btn btn-primary activate-button-user" userId = "' + userId + '">ACTIVATE</button>');
            },
            error: function () {
                alert("FAIL");
            }
        });
});

$(document).on("click", ".activate-button-user", function() {
    var userId = $(this).attr('userId');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/admin/users/activate",
            data: {
                user_id: userId
            },
            success: function () {
                //alert("SUCCESS");
                var tmp = '#user-row-' + userId;
                $(tmp + " td span").replaceWith('<span class="label label-success">Activated</span>');
                $(tmp + " .activate-button-user").replaceWith('<button class="btn btn-warning deactivate-button-user" userId = "' + userId + '">DEACTIVATE</button>');
            },
            error: function () {
                alert("FAIL");
            }
        });
});
