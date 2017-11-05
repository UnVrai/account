/**
 * Created by UnVrai on 2017/4/6.
 */
function create(url, printUrl) {

    $.ajax({
        type: "POST",
        url:url,
        data:$('#order').serialize(),
        success: function(data) {
            if (data != "") {
                var serial = parseInt(data);
                $('#serial').val(serial + 1);
                print(data, printUrl);
            }
        }
    });
}

function print(id, printUrl) {
    var data = {};
    data.id = id;
    data._token = $('#token').val();
    $.ajax({
        type: "POST",
        url:printUrl,
        data:data,
        success: function(data) {
            document.getElementById("iPrint").src = data;
        }
    });

}