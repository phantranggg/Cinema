/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

$(document).on('change', '#select-theater', function() {
// $("#select-theater").change(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "GET",
        url: "/admin/schedule/filter/",
        data: {
            theater_id: $(this).val()
        },
        success: function (data) {
            $("#changeable_content").html(data);
        },
        error: function () {
            alert("FAIL");
        }
    });
});