<?php
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/classes/reviewtable.php';
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/classes/validator.php';

$data = [
    'errors' => []
];

if (empty($_POST))
{
    $data['errors'][] = 'Отсутствуют входные данные!';
}
else
{
    $prepareData = [
        'email' => trim($_POST['email'] ?? ''),
        'name' => trim($_POST['name'] ?? ''),
        'text' => trim($_POST['text'] ?? ''),
    ];

    $validator = new Validator($prepareData);

    $data['errors']['email'] = join('<br/>', $validator->getEmailErrors());
    $data['errors']['name'] = join('<br/>', $validator->getNameErrors());
    $data['errors']['text'] = join('<br/>', $validator->getTextErrors());

    foreach ($data['errors'] as $errorGroup)
    {
        if (empty($errorGroup) === false)
        {
            die(json_encode($data));
        }
    }

    $prepareData['email'] = htmlspecialchars($prepareData['email']);
    $prepareData['name'] = htmlspecialchars($prepareData['name']);
    $prepareData['text'] = htmlspecialchars($prepareData['text']);

    $data['result'] = ReviewTable::Create($prepareData);
}

die(json_encode($data));