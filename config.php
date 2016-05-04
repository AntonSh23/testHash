<?php
/**
 * Created by PhpStorm.
 * User: ashulpekov
 * Date: 04.05.2016
 * Time: 11:23
 */

Router::$config = [
    'DB' => [
        'hostname' => 'localhost',
        'hostport' => '127.0.0.1',
        'database' => 'hash_storage',
        'charset' => 'utf8',
        'user' => 'greendbuser',
        'password' => 'fegdHreUeg7f2',
    ],
    'autoload' => [
        'vendor',
        'db',
        'print',
    ],
];