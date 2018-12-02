<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:32 AM
 * estimate how long to wait
 */
define('WAIT', 20);
session_start();
require_once MODEL_PATH."DBQueue.php";
require_once MODEL_PATH."DBStoreState.php";

if(!isset($_SESSION['store_id']))
{
    $msg = array('state' => 'nologin');
    die(json_encode(($msg)));
}

$store_id = $_SESSION['store_id'];
$check = new DBStoreState();
$result = $check->checkOpen($store_id);
if($result){
    $call =  new DBQueue();
    $data = $call->getNumber($store_id);
    $arr = array('number' => $num*WAIT, );
    return json_encode($arr);

}else{
    $json = '{"state":"store is not open"}';
    echo $json;
    return ;
}
