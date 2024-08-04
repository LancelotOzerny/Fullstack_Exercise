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
        $model = new ReviewsModel();
        $response = [];

        $data = [
            'email' => $this->request->getPost('email'),
            'name' => $this->request->getPost('name'),
            'text' => $this->request->getPost('text'),
        ];

        $response = $model->createReview($data);

        return json_encode($response);
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