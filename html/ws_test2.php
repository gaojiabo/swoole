<?php
//echo phpinfo();exit;
//$redis = new Redis();
//$redis->connect('127.0.0.1',6379);
//$redis->select(0);
//$redis->sAdd('myWsSet',1);
//$redis->sAdd('myWsSet',2);
//$redis->sAdd('myWsSet',3);
//echo '<pre/>';
//print_r($redis->sMembers('myWsSet'));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        #content{
            width: 330px;
            height: 500px;
            border: red groove 2px;
            overflow-y: auto;
        }
        #ask{
            border: green double 2px;
        }
        .right{
            text-align: right;
        }
        .p{
            height: 15px;
            width: inherit;
            margin-top: 8px;
        }
    </style>
</head>
<body>
<ul>
    <div id="content"></div>
    <input type="text" name="" id="ask">
    <button>清空</button>
    <button>发送</button>
</ul>
</body>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    //var wsServer = 'ws://10.240.0.73:9502';
    var wsServer = 'ws://127.0.0.1:9502';
    var websocket = new WebSocket(wsServer);
    //console.log(websocket);
    websocket.onopen = function (evt) {
        //console.log("Connected to WebSocket server.");
        alert('已连接服务器！');
    };

    websocket.onclose = function (evt) {
        console.log("Disconnected");
    };
    websocket.onmessage = function (evt) {
        $('#content').append('<p class="left p">'+evt.data+'</p>');
    };

    websocket.onerror = function (evt, e) {
        console.log('Error occured: ' + evt.data);
    };
    function sendMs(msg){
        if(!msg){
            alert('发送数据不能为空！');
            return false;
        }
        if (websocket.readyState===1) {
            websocket.send(msg);
        }else{
            alert('fail');
        }

    }
    $(function () {
        $('ul button:last').on('click',function () {
            var msg = $('#ask').val();
            sendMs(msg)
            //$('#content').append('<p class="left p">我说：'+msg+'</p>');
        })
    })
</script>
</html>
