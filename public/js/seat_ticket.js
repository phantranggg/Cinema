var status = ($('.process-right-seatmap')).attr('data');
var totalmoney = document.getElementById("total").innerHTML;
var array;
var delete_chairs = [];

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

function changeNextButtonStatus() {
    if (totalmoney ) {
        $('.process-right-seatmap').prop('disabled', false);
        $('.process-right-seatmap').css("cursor", "pointer");
    } else {
        $('.process-right-seatmap').prop('disabled', true);
        $(".process-right-seatmap").removeAttr("style");
    }
}

$("#next").click(function () {
    if ((typeof status === "undefined") || (status=='pair-mode' && array.length==2)) {
        $(".bill").css("display", "block");
    }
    $(".process-right-seatmap").css("display", "block");
})

var hadSeat = $('.string-chair').attr('data-id3');
console.log(hadSeat);
if (hadSeat != null) {
    array = hadSeat.split(" ");
}

var price = $('#total').attr('data-id4');

var scheduleId = $('.seats').attr('data-id2');
$('.seats').click(function () {
    var seatNum = ($(this).attr('data-id1'));
    if ($(this).is(':checked')) {
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
                $('#total').html(totalmoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND");
                $('#total-bill').html(totalmoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND");
                changeNextButtonStatus()
            },
            error: function () {
                alert('error');
            }
        });
    } else {
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
                $('#total').html(totalmoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND");
                $('#total-bill').html(totalmoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND");
                changeNextButtonStatus()
            },
            error: function () {
                alert('error');
            }
        });
    }
});

$('.process-right-seatmap').click(function () {
    if (status=='pair-mode' && array.length!=2) {
        alert('Bạn phải chọn đúng 2 vé');
    }   
    if ((status!='pair-mode') || (status=='pair-mode' && array.length==2)) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/user/bill",
            data: {
                seat_list: array,
                schedule_id: scheduleId
            },
            success: function (data) {
                console.log(data);
                $('#total-bill').html(totalmoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND");
                $('#ticketModal').modal('show');
            },
            error: function () {
                alert('Có lỗi đã xảy ra. Vui lòng thử lại');
            }
        });
    }
});

$('#close-btn').click(function() {
    $('#redirect').trigger('click');
})
