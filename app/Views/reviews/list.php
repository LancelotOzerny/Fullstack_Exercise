<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="assets/css/bootstrap-4.4.1.css">
</head>
<body>
<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h2 class="text-center">Тестовое задание: CR<s>U</s>D комментариев</h2>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><a href="#" class="text-dark sort-mode" data-sort="id">ID</a></th>
                    <th><a href="#" class="text-dark sort-mode" data-sort="name">Никнейм</a></th>
                    <th><a href="#" class="text-dark sort-mode" data-sort="email">Email</a></th>
                    <th>Комментарий</th>
                    <th><a href="#" class="text-dark sort-mode" data-sort="date">Создан</a></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="ReviewsList"></tbody>
            </table>
        </div>
    </div>
</div>

<div id="MessageGroup" class="toast-container position-fixed" style="right: 25px; top: 25px; z-index: 11"></div>


<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <form class="form">
                <div class="navigation-wrapper d-flex justify-content-center">
                    <div id="PageButtonsGroup" class="navigation btn-group btn-group-lg"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-5">
        <div class="col-12">
            <form class="form">
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="InputEmail">Ваш почтовый ящик</label>
                        <input id="InputEmail"
                               class="form-control"
                               type="email"
                               placeholder="your.email@address.domen">
                        <div class="form-text text-muted">
                            <small>Не забудьте домен и символ собачки</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="InputEmail">Ваше имя</label>
                        <input id="InputName"
                               class="form-control"
                               type="text"
                               placeholder="your name">
                        <div class="form-text text-muted">
                            <small>Имя может содержать от 4 до 16 латинских символов</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="InputMessage">Напишите комментарий в двух словах</label>
                        <textarea class="form-control"
                                  id="InputMessage"
                                  placeholder="Ваше текстовое сообщение"
                                  style="min-height: 250px"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button id="CreateButton" type="button" class="btn btn-success">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/jQuery-3.7.1.js"></script>
<script src="assets/js/bootstrap.js"></script>

<script src="assets/js/script.js"></script>

<script>
    ReviewsTable.Update();

    $("#CreateButton").click(() => {
        ReviewsTable.Create()
    });

    $(".sort-mode").click(function() {
        let sortBy = $(this).attr('data-sort');
        if (sortBy === ReviewsTable.sort['by'])
        {
            ReviewsTable.sort['direction'] = ReviewsTable.sort['direction'] === 'desc' ? 'asc' : 'desc';
        }
        else
        {
            ReviewsTable.sort['by'] = sortBy;
        }

        ReviewsTable.Update();
    });
</script>
</body>
</html>