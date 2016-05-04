<?php
/**
 * Created by PhpStorm.
 * User: ashulpekov
 * Date: 04.05.2016
 * Time: 11:14
 */
if($_REQUEST['action']!='getAllFilesData')require_once('hash_view.php');
require_once('hash_model.php');

class Hash_ctrl {

    function saveFile(){
        $hash_model = new Hash_model();
        echo $hash_model->setFile();

    }

    function getAllFilesData(){
        $hash_model = new Hash_model();
        $dbData = $hash_model->getAllFilesDBData();
        Router::$response = $dbData;
        ob_end_clean();
        ob_start();
        Router::returnResponse();
    }

    function getFileFromServer(){
        ob_end_clean();
        ob_start();
        $file = $_REQUEST['path'];

        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=".$file);
        readfile($file);
    }
}

