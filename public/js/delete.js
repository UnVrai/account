function deleteOrder(url) {
    $.ajax({
        type: "POST",
        url:url,
        data:$('#delete').serialize(),
        success: function(data) {
            window.location.reload();
        }
    });
}