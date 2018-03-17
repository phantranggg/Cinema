var totalmoney = document.getElementById("total").innerHTML;
var array;

if (totalmoney == '') {
    totalmoney = 0;
    array = [];
} else {
    totalmoney = parseInt(totalmoney);
}

function renderHTML(arr) {
    res = "";
    for (i = 0; i < arr.length; i++) {
        res += arr[i];
        if (i < arr.length - 1) {
            res += ', ';
        }
    }
    return res;
}

$("#next").click(function() {
    $(".bill").css("display","block");
    $(".process-right-seatmap").css("display","block");
})

var hadSeat = $('.string-chair').attr('data-id3');
console.log(hadSeat);
if (hadSeat != null) {
    array = hadSeat.split(" ");
}

var price = $('#total').attr('data-id4');
console.log(price);

var scheduleId = $('.seat').attr('data-id2');
$('.seat').click(function () {
    var seatNum = ($(this).attr('data-id1'));
    if (!$(this).hasClass('chosen')) {
        if ($(this).hasClass('uncheck')) {
            $(this).css('background-color', '#FF7E75');
            $(this).removeClass('uncheck');
            $(this).addClass('checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                success: function (data) {
                    array.push(seatNum);
                    $('.movie-seats').html(renderHTML(array));
                    totalmoney = price * array.length;
                    $('#total').html(totalmoney);
                    $('#total-bill').html(totalmoney);
                },
                error: function () {
                    alert('error');
                }
            });
        } else if ($(this).hasClass('checked')) {
            $(this).css('background-color', '#FFFFFF');
            $(this).removeClass('checked');
            $(this).addClass('uncheck');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                success: function (data) {
                    array.splice(array.indexOf(seatNum), 1);
                    $('.movie-seats').html(renderHTML(array));
                    totalmoney = price * array.length;
                    $('#total').html(totalmoney);
                    $('#total-bill').html(totalmoney);
                },
                error: function () {
                    alert('error');
                }
            });
        } else if ($(this).hasClass('myseat')) {
            $(this).css('background-color', '#FFFFFF');
            $(this).removeClass('myseat');
            $(this).addClass('uncheck');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/theaters/ticketDelete",
                data: {
                    schedule_id: scheduleId,
                    seat_num: seatNum
                },
                success: function (data) {
                    array.splice(array.indexOf(seatNum), 1);
                    $('.movie-seats').html(renderHTML(array));
                    totalmoney = price * array.length;
                    $('#total').html(totalmoney);
                    $('#total-bill').html(totalmoney);
                },
                error: function () {
                    alert('error');
                }
            });
        }
        ;
    }
});

$('.process-right-seatmap').click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/theaters/bill",
        data: {
            seat_list: array,
            schedule_id: scheduleId
        },
        success: function (data) {
            $('#total-bill').html(totalmoney);
        },
        error: function () {
            alert('error');
        }
    });
});