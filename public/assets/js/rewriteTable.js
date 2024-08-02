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

            for (let i = 0, count = dataList['reviews'].length; i < count; ++i)
            {
                let tr = GetTr(dataList['reviews'][i]);
                list.append(tr);
            }

            RewritePageButtons(4);
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
          class: 'btn btn-' + (i !== 0 ? 'outline-' : '') + 'secondary',
          text: i,
      });

      btnGroup.append(button);
    }
}