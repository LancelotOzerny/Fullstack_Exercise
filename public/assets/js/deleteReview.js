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

            if (ReviewsConfig['reviewsCount'] % ReviewsConfig['countOnPage'] === 1 && ReviewsConfig['activePage'] > 0)
            {
                ReviewsConfig['activePage']--;
            }

            RewriteTable();


            OutputAjaxAlerts(
                dataList,
                'Пользователь успешно удален',
                'При удалении пользователя произошла ошибка',
            );
        },
    });
}