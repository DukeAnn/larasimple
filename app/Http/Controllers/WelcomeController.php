<?php
/**
 * Created by PhpStorm.
 * User: ADKi
 * Date: 2017/7/19 0019
 * Time: 9:40
 * @author DukeAnn
 */

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Container\Container;

class WelcomeController
{
    public function index()
    {
        $student = Student::first();
        $data = $student->getAttributes();
        $app = Container::getInstance();
        $factory = $app->make('view');
        // 调用视图传输数据
        return $factory->make('welcome')->with('data', $data);
    }
}