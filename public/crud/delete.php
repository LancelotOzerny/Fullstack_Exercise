<?php
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/classes/reviewtable.php';

$data = [];

if (isset($_POST['id']))
{
    $id = intval($_POST['id']);
    $data['ready'] = ReviewTable::delete($id);
}
else
{
    $data['errors'][] = 'Данные о комментарии для удаления не найдены!';
}

die(json_encode($data));