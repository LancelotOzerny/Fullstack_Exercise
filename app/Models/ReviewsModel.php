<?php
namespace App\Models;

class ReviewsModel extends \CodeIgniter\Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'name', 'text'];


    public function createReview($data)
    {
        if ($this->validateReview($data))
        {
            if ($this->insert($data))
            {
                return ['result' => true];
            }
            else
            {
                return ['errors'=> ['Ошибка при создании пользователя']];
            }
        }
        else
        {
            return ['errors' => $this->validator->getErrors()];
        }
    }
    protected function validateReview($data)
    {
        $this->validator = \Config\Services::validation();

        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Поле Email обязательно!',
                    'valid_email' => 'Поле Email некорректно!'
                ]
            ],
            'name' => [
                'rules' => 'required|alpha_numeric_space|min_length[4]|max_length[16]',
                'errors' => [
                    'required' => 'Поле Имя обязательно',
                    'alpha_numeric_space' => 'Имя может содержать только буквы, цифры и пробелы',
                    'min_length' => 'Имя может содержать от 4 до 16 символов',
                    'max_length' => 'Имя может содержать от 4 до 16 символов'
                ]
            ],
            'text' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Поле сообщение обязательно к заполнению'
                ]
            ]
        ];

        return $this->validator->setRules($rules)->run($data);
    }
}