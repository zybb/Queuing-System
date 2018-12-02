<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:17 AM
 */


session_start();

session_unset();
session_destroy();

$msg = array("state" => "ok");
die(json_encode($msg));

