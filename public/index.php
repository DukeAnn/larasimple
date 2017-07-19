<?php
/**
 * Created by PhpStorm.
 * User: ADKi
 * Date: 2017/7/19 0019
 * Time: 9:28
 * @author DukeAnn
 */
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Fluent;

require  __DIR__.'/../vendor/autoload.php';

// 实例化服务器容器
$app = new Illuminate\Container\Container;

// 注册视图组件
Illuminate\Container\Container::setInstance($app);

// 注册事件、路由提供者
with(new Illuminate\Events\EventServiceProvider($app))->register();

with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

// 启动Eloquent ORM数据库模块，并初始化
$manager = new Manager();
$manager->addConnection(require __DIR__.'/../config/database.php');
// 启动模块
$manager->bootEloquent();

// 视图模块
$app->instance('config', new Fluent);

// 视图路径设置
$app['config']['view.compiled'] = __DIR__.'/../storage/framework/views';
$app['config']['view.paths'] = [__DIR__.'/../resources/views'];

// 视图服务器提供者注册
with(new Illuminate\View\ViewServiceProvider($app))->register();
with(new Illuminate\Filesystem\FilesystemServiceProvider($app))->register();

// 引入路由文件
require __DIR__.'/../app/Http/routes.php';

// 实例化Http请求，分发给路由
$request = Illuminate\Http\Request::createFromGlobals();
$response = $app['router']->dispatch($request);

// 向浏览器发送响应
$response->send();