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

    public static function read(array $data = []) : array
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

    public static function create(array $insertData) : bool
    {
        $keys = array_keys($insertData);

        $valuesStr = '';
        $paramsStr = '';

        for ($i = 0, $count = count($keys); $i < $count; ++$i)
        {
            $key = $keys[$i];
            $valuesStr .= ":$key";
            $paramsStr .= "`$key`";

            if ($i !== $count -1)
            {
                $valuesStr .= ", ";
                $paramsStr .= ", ";
            }
        }

        $sql = "INSERT INTO Reviews ($paramsStr) VALUES ($valuesStr)";
        $prepare = DataBase::connection()->prepare($sql);

        foreach ($insertData as $key => $value)
        {
            $prepare->bindValue(":$key", $value);
        }

        return $prepare->execute();
    }
}