<?php
define('ROOT',dirname(__FILE__).DIRECTORY_SEPARATOR);
set_include_path(".".PATH_SEPARATOR.ROOT);
require_once 'test.php';
$http = new swoole_http_server("0.0.0.0", 9501);
$http->on('request', function ($request, $response) {
//     if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
//         return $response->end();
//     }
//     var_dump($request->get, $request->post);
//     $response->header("Content-Type", "text/html; charset=utf-8");
//     $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
	list($controller, $action) = explode('/', trim($request->server['request_uri'], '/'));
//	var_dump($controller);
//	var_dump($action);exit;
    //根据 $controller, $action 映射到不同的控制器类和方法
    (new $controller)->$action($request, $response);
});

$http->start();

//class test{
//    public function index(){
//        $params = $_GET;
//        print_r($params);
//        echo 123;exit;
//    }
//}

?>