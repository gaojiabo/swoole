<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<button class="btn">测试异步任务</button>
</body>
</html>
<script type="text/javascript">
    var wsServer = 'ws://127.0.0.1:9501';
    var websocket = new WebSocket(wsServer);
    websocket.onopen = function (evt) {
        //console.log("Connected to WebSocket server.");
        alert('已连接服务器！');
    };
    websocket.onmessage = function (evt) {
        console.log(evt.data);
    };

    function sendMs(msg){
        if(!msg){
            alert('发送数据不能为空！');
            return false;
        }
        console.log(websocket)
        if (websocket.readyState===1) {
            websocket.send(msg);
        }else{
            alert('fail');
        }

    }
    window.onload = function () {
        $(".btn").onclick = function (event) {
            sendMs('gaojianbo');
        }
    }
    function $(name) {
        var reg1 = RegExp(/\./);
        var reg2 = RegExp(/#/);
        if(name.match(reg1)){
            return document.querySelector(name);
        }
        if(name.match(reg2)){
            return document.getElementById(name);
        }
    }
</script>