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
            RewriteTable();

            $("#CreateButton").removeClass('disabled');

            OutputAjaxAlerts(
                dataList,
                'Пользователь успешно создан',
                'При создании пользователя произошла ошибка',
            );
        },
        fail: (data) => {
            $("#CreateButton").removeClass('disabled');
            AlertMessage('При создании пользователя произошла ошибка', 'danger');
        }
    });
}

function OutputAjaxAlerts(data, successMessage, failureMessage)
{
    let errorExists = false;
    for (let key in data['errors'])
    {
        if (data['errors'][key].length > 0)
        {
            AlertMessage([key, data['errors'][key]], 'danger');
            errorExists = true;
        }
    }

    if (errorExists)
    {
        return;
    }

    if (data['result'])
    {
        AlertMessage([successMessage]);
    }
    else
    {
        AlertMessage([failureMessage], 'danger');
    }
}