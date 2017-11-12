function deleteFuc(url) {
    if (confirm('是否确定删除')) {
        var data = {};
        data._method = 'DELETE';
        data._token = $('#token').val();
        $.ajax({
            type: "POST",
            url:url,
            data:data,
            success: function(data) {
                window.location.reload();
            }
        });
    }
}