<?php

namespace App\Controllers;

class ReviewsController extends BaseController
{
    public function list()
    {
        return view('reviews/list');
    }

    public function create()
    {
        return json_encode([]);
    }

    public function read()
    {
        return json_encode([]);
    }

    public function delete()
    {
        return json_encode([]);
    }
}