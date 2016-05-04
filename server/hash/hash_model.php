<?php

/**
 * Created by PhpStorm.
 * User: ashulpekov
 * Date: 04.05.2016
 * Time: 11:14
 */
class Hash_model
{
    function setFile(){
        $currDate = date("Y-m-d_H-i-s");
        $uploadDir = 'data/'.$currDate;
        mkdir($uploadDir, 0700);
        $uploadDir .= '/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            Router::query_execute('INSERT INTO `unit_data` (`unit_link`, `date_written`, `filename`) VALUES ("'.$uploadDir.'", "'.$currDate.'", "'.$_FILES['file']['name'].'")');
            return 'Успешно загружено';
        } else {
            return 'Ошибка!';
        }
    }

    function getAllFilesDBData(){
        return Router::query_select('SELECT id, unit_link, date_written, filename FROM hash_storage.unit_data;');
    }
}