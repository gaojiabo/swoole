<?php
//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);
$ws->set(array(
    'task_worker_num' => 1,
));
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    foreach ($ws->connections as $v){
        //投递异步任务
        $task_id = $ws->task($frame->data);
        //$ws->push($v,$frame->data);
    }

});
//处理异步任务
$ws->on('task', function ($ws, $task_id, $from_id, $data) {

    echo "New AsyncTask[id=$task_id]".PHP_EOL;
    //返回任务执行的结果
    $ws->finish("$data -> OK");
});
//处理异步任务的结果
$ws->on('finish', function ($ws, $task_id, $data) {
    //echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
    foreach ($ws->connections as $v){
        $ws->push($v,'已处理完毕fd=>'.$v);
    }
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();
?>