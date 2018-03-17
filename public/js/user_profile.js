function openLink(evt, animName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(animName).style.display = "block";
    evt.currentTarget.className += " w3-red";
}

$('.delete-button-ticket').click(function() {
    var schedule_id = $(this).attr('data-id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/users/tickets/delete",
        data: {
            schedule_id: schedule_id
        },
        success: function (data) {
            var tmp = '.bill-' + schedule_id;
            $(tmp).hide();
        },
        error: function () {
            alert("ERROR");
        }
    });
});