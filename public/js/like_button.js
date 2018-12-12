$(".btn-like").click(function () {
    var id = ($(this).attr('data-id'));
    if ($(this).hasClass('liked')) {
        console.log('unlike');
        $(this).removeClass('liked');
        $(this).addClass('unlike');
        var iconLike = $(this).find('.icon-like');
        iconLike.addClass('thumb-off');
        iconLike.removeClass('fa fa-check');
        iconLike.removeClass('thumb-off');
        iconLike.addClass('fa fa-thumbs-o-up');
        //iconLike.toggleClass
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/customer/user/unlike",
            data: {
                movie_id: id
            },
            success: function () {
                //alert("SUCCESS");
            },
            error: function () {
                alert("FAIL");
            }
        });
    } else {
        console.log('like');
        $(this).removeClass('unlike');
        $(this).addClass('liked');
        var iconLike = $(this).find('.icon-like');
        iconLike.addClass('thumb-off');
        iconLike.removeClass('fa fa-thumbs-o-up');
        iconLike.removeClass('thumb-off');
        iconLike.addClass('fa fa-check');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/customer/user/like",
            data: {
                movie_id: id
            },
            success: function () {
                //alert("SUCCESS");
            },
            error: function () {
                alert("FAIL");
            }
        });
    }
});

$(".btn-auth").click(function() {
    alert("Bạn phải đăng nhập mới sử dụng được tính năng like");
});
