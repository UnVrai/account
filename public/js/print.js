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
        },
        error:function (data) {
            alert(data.responseJSON.message);
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

function openPrint() {
    document.getElementById("iPrint").focus(); document.getElementById("iPrint").contentWindow.print();
}
$(document).ready(function(){
    if (document.getElementById("iPrint").attachEvent) {

        document.getElementById("iPrint").attachEvent("onload", function () {
            setTimeout('openPrint()', 500)
        });
    } else {
        document.getElementById("iPrint").onload = function () {
            setTimeout('openPrint()', 500)
        }
    }
})