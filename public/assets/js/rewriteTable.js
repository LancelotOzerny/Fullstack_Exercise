let ReviewsConfig = {
    'countOnPage': 3,
    'activePage': 0,
    'reviewsCount': 0,
}

function RewriteTable()
{
    $.ajax({
        url: '/crud/read.php',
        method: 'post',
        data: {
            'limit' : ReviewsConfig['countOnPage'],
            'offset' : ReviewsConfig['activePage'] * ReviewsConfig['countOnPage'],
        },
        success: (data) => {
            let dataList = JSON.parse(data);

            let list = $("#ReviewsList");
            list.html('');

            for (let i = 0, count = dataList['reviews'].length; i < count; ++i)
            {
                let tr = GetTr(dataList['reviews'][i]);
                list.append(tr);
            }

            ReviewsConfig['reviewsCount'] = dataList['count'];
            RewritePageButtons(ReviewsConfig['reviewsCount'] / ReviewsConfig['countOnPage']);
        },
    });
}

function GetTr(review)
{
    let tr = $('<tr>');

    let deleteButton = $("<button>", {
        class: 'btn btn-danger text-uppercase',
        text: 'delete',
    });

    deleteButton.click(function() {
        Delete(review['id']);
    });

    tr.append($("<th>", { text: review['id'] }))
    tr.append($("<td>", { text: review['name'] }))
    tr.append($("<td>", { text: review['email'] }))
    tr.append($("<td>", { text: review['text'] }))
    tr.append($("<td>", { text: review['date'] }))
    tr.append($("<td>").append(deleteButton));

    return tr;
}

function RewritePageButtons(pageButtonsCount)
{
    let btnGroup = $("#PageButtonsGroup");
    btnGroup.html('');

    for (let i = 0; i < pageButtonsCount; ++i)
    {
      let button = $("<button>", {
          type: 'button',
          class: 'btn btn-' + (i !== ReviewsConfig['activePage'] ? 'outline-' : '') + 'secondary',
          text: i + 1,
      });

      button.click(function() {
          $("#PageButtonsGroup>button").addClass('disabled')
          ReviewsConfig['activePage'] = i;
          RewriteTable();
          $("#PageButtonsGroup>button").removeClass('disabled')
      });

      btnGroup.append(button);
    }
}