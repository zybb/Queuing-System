<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/12/2
 * Time: 1:12 PM
 */
session_start();
require_once MODEL_PATH."DBStoreState.php";

if(!isset($_SESSION['store_id']))
{
    $msg = array('state' => 'nologin');
    die(json_encode(($msg)));
}

$store_id = $_SESSION['store_id'];
$check = new DBStoreState();
$result = $check->closeStore($store_id);