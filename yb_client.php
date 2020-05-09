<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/13
 * Time: 11:12
 */
class Client{
    private $client;
    //初始化
    public function __construct(){
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
    }
    //连接服务
    public function connect(){
        if(!$this->client->connect("127.0.0.1",9501,-1)){
            throw new Exception(sprintf('Swoole Error: %s', $this->client->errCode));
        }
    }
    //发送
    public function send($data)
    {
        if ($this->client->isConnected()) {
            if (!is_string($data)) {
                $data = json_encode($data);
            }

            return $this->client->send($data);
        } else {
            throw new Exception('Swoole Server does not connected.');
        }
    }
    //关闭
    public function close()
    {
        $this->client->close();
    }
}
//$data = array(
//    "url" => "http://192.168.10.19/send_mail",
//    "param" => array(
//        "username" => 'test',
//        "password" => 'test'
//    )
//);
$data = 'gaojianbop';
$client = new Client();
$client->connect();
if ($re = $client->send($data)) {
    echo 'success'.PHP_EOL;
} else {
    echo 'fail';
}
var_dump("This is return data ".$client->recv(65535,true));
$client->close();