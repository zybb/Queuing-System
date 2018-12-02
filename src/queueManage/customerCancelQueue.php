<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:29 AM
 */


session_start();
require_once MODEL_PATH."DBQueue.php";
$store_id = $_POST['store_id'];

if(!isset($_SESSION['customer_id']))
{
    $msg = array('state' => 'nologin');
    die(json_encode(($msg)));
}

$customer_id = $_SESSION['customer_id'];

$call =  new DBQueue();
$result = $call->cancelQueue($customer_id,$store_id);
if($result == 0) {
    $json = '{"state":"success to cancel "}';
    echo $json;
    return ;
}elseif ($result == -1){
    $json = '{"state":"queue is empty "}';
    echo $json;
    return ;
}else{
    $json = '{"state":"failed to cancel "}';
    echo $json;
    return ;
}
