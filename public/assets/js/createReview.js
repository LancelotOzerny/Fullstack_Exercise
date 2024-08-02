function Create()
{
    $("#CreateButton").addClass('disabled');
    $.ajax({
        url: '/crud/create.php',
        method: 'post',
        data: {
            'email' : $('#InputEmail').val(),
            'name' : $('#InputName').val(),
            'text' : $('#InputMessage').val(),
        },
        success: (data) => {
            let dataList = JSON.parse(data);
            console.log(dataList);
            RewriteTable();
            $("#CreateButton").removeClass('disabled');
        },
        fail: (data) => {
            $("#CreateButton").removeClass('disabled');
        }
    });
}