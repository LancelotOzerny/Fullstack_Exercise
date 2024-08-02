function UpdateTable()
{
    let list = $("#ReviewsList");

    list.html(getTr({
        'id': '0',
        'name': 'username',
        'email': 'test@test.ru',
        'text': 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem ',
        'date': '23:04:12 23.12.2023',
    }))

    function getTr(review)
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
}

function Delete(id)
{
    console.log('Deleted ' + id);
}