<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:33 AM
 */

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
    $num = $call->callRepeatNumber($store_id);
    if($num) {
        $arr = array('number' => $num, );
        return json_encode($arr);
    }else{
        $json = '{"state":"queue is empty"}';
        echo $json;
        return ;
    }

}else{
    $json = '{"state":"you should open store first"}';
    echo $json;
    return ;
}

