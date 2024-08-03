class ReviewsTable
{
    static countOnPage = 3;
    static activePage = 0;
    static reviewsCount = 0;
    static sort = {
        'by': 'id',
        'direction': 'asc',
    };

    static Remove(id)
    {
        $.ajax({
            url: '/crud/delete.php',
            method: 'post',
            data: {
                'id' : id
            },
            success: (data) => {
                let dataList = JSON.parse(data);

                if (ReviewsTable.reviewsCount % ReviewsTable.countOnPage === 1 && ReviewsTable.activePage > 0)
                {
                    ReviewsTable.activePage--;
                }

                ReviewsTable.Update();

                ReviewsTable.OutputAjaxAlerts(
                    dataList,
                    'Пользователь успешно удален',
                    'При удалении пользователя произошла ошибка',
                );
            },
        });
    }

    static Create()
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
                ReviewsTable.Update();

                $("#CreateButton").removeClass('disabled');

                ReviewsTable.OutputAjaxAlerts(
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

    static Update()
    {
        $.ajax({
            url: '/crud/read.php',
            method: 'post',
            data: {
                'limit' : ReviewsTable.countOnPage,
                'offset' : ReviewsTable.activePage * ReviewsTable.countOnPage,
                'sort': ReviewsTable.sort,
            },
            success: (data) => {
                let dataList = JSON.parse(data);

                let list = $("#ReviewsList");
                list.html('');

                for (let i = 0, count = dataList['reviews'].length; i < count; ++i)
                {
                    let tr = ReviewsTable.GetTr(dataList['reviews'][i]);
                    list.append(tr);
                }

                ReviewsTable.reviewsCount = dataList['count'];
                ReviewsTable.RewritePageButtons(ReviewsTable.reviewsCount / ReviewsTable.countOnPage);
            },
        });
    }

    static GetTr(review)
    {
        let tr = $('<tr>');

        let deleteButton = $("<button>", {
            class: 'btn btn-danger text-uppercase',
            text: 'delete',
        });

        deleteButton.click(function() {
            ReviewsTable.Remove(review['id'])
        });

        tr.append($("<th>", { text: review['id'] }))
        tr.append($("<td>", { text: review['name'] }))
        tr.append($("<td>", { text: review['email'] }))
        tr.append($("<td>", { text: review['text'] }))
        tr.append($("<td>", { text: review['date'] }))
        tr.append($("<td>").append(deleteButton));

        return tr;
    }

    static RewritePageButtons(pageButtonsCount)
    {
        let btnGroup = $("#PageButtonsGroup");
        btnGroup.html('');

        for (let i = 0; i < pageButtonsCount; ++i)
        {
            let button = $("<button>", {
                type: 'button',
                class: 'btn btn-' + (i !== ReviewsTable.activePage ? 'outline-' : '') + 'secondary',
                text: i + 1,
            });

            button.click(function() {
                $("#PageButtonsGroup>button").addClass('disabled')
                ReviewsTable.activePage = i;
                ReviewsTable.Update();
                $("#PageButtonsGroup>button").removeClass('disabled')
            });

            btnGroup.append(button);
        }
    }

    static OutputAjaxAlerts(data, successMessage, failureMessage)
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
}

function AlertMessage(messageList, type = 'success', destroyTime = 10000)
{
    let alert = $("<div>", {
        class: 'toast show position-relative'
    });

    let message = '<span>';
    for (let i = 0, count = messageList.length; i < count; ++i)
    {
        message += messageList[i];
        if (i !== count - 1)
        {
            message += '<br>';
        }
    }
    message += '</span>';

    let html = '<div class="toast-body alert-' + type + ' d-flex justify-content-between">\n' + message + '<div>\n' +
        '<button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="toast">Закрыть</button></div></div>'

    alert.html(html);

    setTimeout(() => {
        alert.remove();
    }, destroyTime);

    $('#MessageGroup').append(alert);
}