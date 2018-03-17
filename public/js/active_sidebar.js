$("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

$("#select-theater-nowplay").change(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/admin/movies/filterNowPlay",
        data: {
            theater_id: $(this).val()
        },
        success: function (data) {
            $("#myTable").html(data);
        },
        error: function () {
            alert("FAIL");
        }
    });
});

$("#select-theater-comesoon").change(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/admin/movies/filterComeSoon",
        data: {
            theater_id: $(this).val()
        },
        success: function (data) {
            $("#myTable").html(data);
        },
        error: function () {
            alert("FAIL");
        }
    });
});