/**
 * Created by UnVrai on 2017/4/6.
 */
function create() {

    $.ajax({
        type: "POST",
        url:'/orderPrint',
        data:$('#order').serialize(),
        success: function(data) {
            if (data == 'success') {
                document.getElementById("iPrint").src = "./order/common/order.pdf";
                var serial = parseInt($('#serial').val());
                $('#serial').val(serial + 1);
            }
        }
    });

}