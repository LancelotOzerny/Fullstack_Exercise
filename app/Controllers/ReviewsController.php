<?php

namespace App\Controllers;

use App\Models\ReviewsModel;

class ReviewsController extends BaseController
{
    public function list()
    {
        return view('reviews/list');
    }

    public function create()
    {
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

            //$validator = new Validator($prepareData);

            //$data['errors']['email'] = join('<br/>', $validator->getEmailErrors());
            //$data['errors']['name'] = join('<br/>', $validator->getNameErrors());
            //$data['errors']['text'] = join('<br/>', $validator->getTextErrors());

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

            //$data['result'] = ReviewTable::Create($prepareData);

            return $data;
        }
    }

    public function read()
    {
        $model = new ReviewsModel();

        $sort = $this->request->getPost('sort');
        $sort_by = $sort['by'];
        $sort_dir = $sort['direction'];

        $limit = intval($this->request->getPost('limit'));
        $offset = intval($this->request->getPost('offset'));

        $data['reviews'] = $model->orderBy($sort_by, $sort_dir)->limit($limit)->offset($offset)->findAll();
        $data['count'] = $model->countAllResults();

        return json_encode($data);
    }

    public function delete()
    {
        $response = [];
        $id = $this->request->getPost('id');
        if ($id)
        {
            $model = new ReviewsModel();
            if ($model->delete($id))
            {
                $response['result'] = true;
            }
            else
            {
                $response['errors'][]  = 'Ошибка при удалении записи';
            }
        }
        else
        {
            $response['errors'][]  = 'Не передан ID записи для удаления';
        }
            return json_encode($response);
    }

}