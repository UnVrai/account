/**
 * Created by UnVrai on 2017/4/6.
 */
function create(url) {

    $.ajax({
        type: "POST",
        url:url,
        data:$('#order').serialize(),
        success: function(data) {
            document.getElementById("iPrint").src = "/order/" +  data;
            var serial = parseInt($('#serial').val());
            $('#serial').val(serial + 1);
        }
    });

}