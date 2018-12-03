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
require_once MODEL_PATH."DBInfoStore.php";
require_once MODEL_PATH."DBInfoCustomer.php";

$customer = $_POST['customer']; //customer's username
$store = $_POST['store']; //store's username

if(!isset($_SESSION['customer']))
{
    $msg = array('state' => 'nologin');
    die(json_encode(($msg)));
}
$dbCustomer = new DBInfoCustomer();
$customer_id = $dbCustomer->getIdByName($customer);
$dbStore = new DBInfoStore();
$store_id = $dbStore->getIdByName($store);




$store_id = $_SESSION['store_id'];
$check = new DBStoreState();
$result = $check->checkOpen($store_id);
if($result){
    $call =  new DBQueue();
    $data = $call->getQueue($store_id);
    for ($i=0;$i < sizeof($data);$i++){
        if($data[$i]['customer_id'] == $customer_id){
            $arr = array('time' => $i*WAIT, );
            return json_encode($arr);
        }

    }

}else{
    $json = '{"state":"store is not open"}';
    echo $json;
    return ;
}
