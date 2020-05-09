<?php
//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9502); 

//监听连接进入事件
$serv->on('connect', function ($serv, $fd) {  
    echo "Client: Connect.\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
	$client = new swoole_client(SWOOLE_SOCK_TCP);
	if (!$client->connect('127.0.0.1', 9501, -1))
	{
	    exit("connect failed. Error: {$client->errCode}\n");
	}
	$client->send("server1 data");
	$returnData2 = $client->recv();
    $serv->send($fd, "Server1说这是: ".$returnData2);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo $fd." <==> Client: Close.\n";
});

//启动服务器
$serv->start(); 
