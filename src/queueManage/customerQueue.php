<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:28 AM
 */

session_start();
require_once MODEL_PATH."DBQueue.php";
$store_id = $_POST['store_id'];


if(!isset($_SESSION['customer_id']))
{
    $msg = array('state' => 'nologin');
    die(json_encode(($msg)));
}

$store_id = $_SESSION['store_id'];
$check = new DBStoreState();
$result = $check->checkOpen($store_id);
if($result == 0)
{
    $json = '{"state":"store is closed "}';
    echo $json;
    return ;
}
$customer_id = $_SESSION['customer_id'];

$call =  new DBQueue();
$result = $call->insertQueueInfo($store_id,$customer_id);
if($result == 1) {
    $json = '{"state":"success queue "}';
    echo $json;
    return ;
}else{
    $json = '{"state":"failed to queue "}';
    echo $json;
    return ;
}
