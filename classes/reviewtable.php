<?php
require_once dirname($_SERVER['DOCUMENT_ROOT'])  . '/classes/database.php';

class ReviewTable
{
    public static function DisplayAll()
    {
        $dbArr = DataBase::connection()->query('SELECT * FROM Reviews');
        $arr = $dbArr->fetchAll(PDO::FETCH_ASSOC);
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    public static function read() : array
    {
        $dbArr = DataBase::connection()->query('SELECT * FROM Reviews');
        $arr = $dbArr->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    public static function delete($id) : bool
    {
        $prepare = DataBase::connection()->prepare('DELETE FROM Reviews WHERE id = :id');
        $prepare->bindValue(':id', $id, PDO::PARAM_INT);
        return $prepare->execute();
    }
}