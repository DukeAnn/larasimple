<?php
/**
 * Created by PhpStorm.
 * User: ADKi
 * Date: 2017/7/19 0019
 * Time: 9:27
 * @author DukeAnn
 */
$app['router']->get('/', function () {
    return '成功';
});

$app['router']->get('welcome', 'App\Http\Controllers\WelcomeController@index');