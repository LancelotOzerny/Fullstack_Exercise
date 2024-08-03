function Alert(message, type = 'success', destroyTime = 10000)
{
    let alert = $("<div>", {
        class: 'toast show position-relative'
    });

    let html = '<div class="toast-body alert-' + type + ' d-flex justify-content-between">\n' + message + '<div>\n' +
        '<button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="toast">Закрыть</button></div></div>'

    alert.html(html);

    setTimeout(() => {
        alert.remove();
    }, destroyTime);

    $('#MessageGroup').append(alert);
}