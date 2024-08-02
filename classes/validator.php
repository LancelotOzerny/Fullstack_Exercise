<?php
class Validator
{
    private array $data = [];

    public function __construct(array $validate_data)
    {
        $this->data = $validate_data;
    }

    public function getEmailErrors(): array
    {
        $errors = [];

        if (empty($this->data['email']))
        {
            $errors[] = 'Поле не может быть пустым!';
        }
        else if (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL))
        {
            $errors[] = 'Email введен некорректно!';
        }

        return $errors;
    }

    public function getTextErrors(): array
    {
        $errors = [];

        if (empty($this->data['text']))
        {
            $errors[] = 'Поле не может быть пустым!';
        }

        return $errors;
    }

    public function getNameErrors(): array
    {
        $errors = [];

        $len = strlen($this->data['name']);

        if (empty($this->data['name']))
        {
            $errors[] = 'Поле не может быть пустым!';
        }
        else if ($len < 4 || $len > 16)
        {
            $errors[] = 'Имя должно содержать от 4 и до 16 символов!';
        }
        else if (!preg_match('/^[A-Za-z0-9]/', $this->data['name']))
        {
            $errors[] = 'Имя может содержать только латинские буквы и цифры!';
        }

        return $errors;
    }
}
