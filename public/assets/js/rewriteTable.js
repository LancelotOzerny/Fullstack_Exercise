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
        data: {},
        success: (data) => {
            let dataList = JSON.parse(data);

            let list = $("#ReviewsList");
            list.html('');

            let reviewsLength = dataList['reviews'].length;
            for (let i = 0; i < reviewsLength; ++i)
            {
                let tr = GetTr(dataList['reviews'][i]);
                list.append(tr);
            }

            ReviewsConfig['reviewsCount'] = reviewsLength;
            RewritePageButtons(reviewsLength / ReviewsConfig['countOnPage']);
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
          ReviewsConfig['activePage'] = i;
          RewriteTable();
      });

      btnGroup.append(button);
    }
}