<?php

/**
 * Created by PhpStorm.
 * User: ashulpekov
 * Date: 04.05.2016
 * Time: 11:17
 */

$route = new Router();
$route->init();

class Router
{

    static $config;
    static $response;
    public $request;
    static $db;

    function init()
    {
        session_start();
        require_once('config.php');

        if ($_REQUEST == '' || empty($_REQUEST) || !isset($_REQUEST['page']))
        {
            $_REQUEST['page'] = 'hash';
            $_REQUEST['action'] = 'saveFile';
        }
        $this->request = $_REQUEST;

        $this->dbConnect();

        $page = $_REQUEST['page'];
        $action = $_REQUEST['action'];

        require_once('server/'.$page.'/'.$page.'_ctrl.php');
        $controller_name = ucfirst($page).'_ctrl';
        $controller = new $controller_name();
        $controller->$action();


        self::returnResponse();
    }


    static function showError($place = __CLASS__, $problem = ' undefined error', $system_message = ' none ')
    {
        self::$response['serverError']['place'] = $place;
        self::$response['serverError']['problem'] = $problem;
        self::$response['serverError']['message'] = $system_message;
        echo json_encode(self::$response);
        die;
    }

    static function returnResponse()
    {

        echo json_encode(self::$response);
        die;
    }


    private function dbConnect()
    {
        $connSTR = 'mysql:host=' . self::$config['DB']['hostname'] . ';' .
            'dbname=' . self::$config['DB']['database'] . ';' .
            'charset=' . self::$config['DB']['charset'];
        try {
            self::$db = new PDO($connSTR, self::$config['DB']['user'], self::$config['DB']['password'],
                array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));
        } catch (PDOException $e) {
            self::showError(__METHOD__, $connSTR, $e->getMessage());
        }
    }

    static function query_select($queryStr = '')
    {
        if ($queryStr == '' || strpos($queryStr, 'INSERT') || strpos($queryStr, 'UPDATE'))
            self::showError(__METHOD__, $queryStr, ' Wrong method using');
        try {
            self::$db->quote($queryStr);
            $result = self::$db->prepare($queryStr);
            $result->execute();
            $dbArray = $result->fetchAll(PDO::FETCH_ASSOC);
            $result->closeCursor();
            return $dbArray;
        } catch (PDOException $e) {
            self::showError(__METHOD__, $queryStr, $e->getMessage());
        }
    }

    static function query_execute($queryStr = '')
    {
        try {
            self::$db->quote($queryStr);
            $result = self::$db->prepare($queryStr);
            return $result->execute();
        } catch (PDOException $e) {
            self::showError(__METHOD__, $queryStr, $e->getMessage());
        }
    }
}