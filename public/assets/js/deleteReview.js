function Delete(id)
{
    $.ajax({
        url: '/crud/delete.php',
        method: 'post',
        data: {
            'id' : id
        },
        success: (data) => {
            let dataList = JSON.parse(data);

            RewriteTable();
        },
    });
}