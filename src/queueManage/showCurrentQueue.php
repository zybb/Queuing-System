<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:30 AM
 * to show the current queue for this store
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
    $data = $call->getQueue($store_id);
    return json_encode($data);

}else{
    $json = '{"state":"store is not open"}';
    echo $json;
    return ;
}
