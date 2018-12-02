<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:21 AM
 */
    session_start();
    require_once MODEL_PATH."DBInfoStore.php";
	require_once MODEL_PATH."DBStoreState.php";
 	header("Content-Type: text/html; charset=utf-8");

 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	$rePassword = $_POST['rePassword'];
 	$email = $_POST['email'];
 	$phone = $_POST['phone'];
 	$specialty = $_POST['describe'];



 	if($username==null || $username==""){
 		$json = '{"state":"username cannot be null"}';
 		echo $json;
 		return ;
 	}

 	if(!preg_match('/^\w\w{0,28}\w$/',$username)){
 		$json = '{"state":"the length of username should be 2-30,only user digits��letters and underlines"}';
 		echo $json;
 		return ;
 	}
 	if($password==null || $password==""){
 		$json = '{"state":"password cannot be null"}';
 		echo $json;
 		return ;
 	}
 	if(strlen($password)>20){
 		$json = '{"state":"the length of username should be less than 20"}';
 		echo $json;
 		return ;
 	}

 	if(strstr($password,"'") || strstr($password,"\"") || strstr($password,";") || strstr($password,"\\")){
 		$json = '{"state":"password should not include spceial char"}';
 		echo $json;
 		return ;
 	}
 	if($password !== $repassword){
 		$json = '{"state":"password should be the same to repassword"}';
 		echo $json;
 		return ;
 	}

 	if(!preg_match('/^\d\d{9}\d$/',$phone)){
 		$json = '{"state":"phone number error"}';
 		echo $json;
 		return ;
 	}

    if($email==null || $email==""){
        $json = '{"state":"email cannot be null"}';
        echo $json;
        return ;
    }
    if(strlen($email)>30){
        $json = '{"state":"the length of email should be less than 30"}';
        echo $json;
        return ;
    }
    if(strstr($email,"'") || strstr($email,"\"") || strstr($email,";") || strstr($email,"\\") || strstr($email,"<") || strstr($email,">")){
        $json = '{"state":"email cannot include special char"}';
        echo $json;
        return ;
    }

 	if(describe==null || describe==""){
 		$json = '{"state":"specialty cannot be null"}';
 		echo $json;
 		return ;
 	}
 	if(strlen(describe)>30){
 		$json = '{"state":"the length of specialty should be less than 30"}';
 		echo $json;
 		return ;
 	}
 	if(strstr($describe,"'") || strstr($describe,"\"") || strstr($describe,";") || strstr($describe,"\\") || strstr($describe,"<") || strstr($describe,">")){
 		$json = '{"state":"specialty should not include special char"}';
 		echo $json;
 		return ;
 	}

 	$check = new DBInfoStore();
	$store_id = $check->addStore($username,$password,$email,$phone,$describe);
 	if($store_id==-2){
 		$json = '{"state":"store already exists"}';
 		echo $json;
 		return ;
 	}else if($store_id>0){
 		$store_id = $check->getIdByName($username);
 		$open = new DBStoreState();
 		$state = $open->setStore($store_id);
 		$_SESSION['store'] = $username;
 		$json = '{"state":"ok"}';
 		echo $json;
 		return ;
 	}else{
 		$json = '{"state":"stmt error"}';
 		echo $json;
 		return ;
 	}

 ?>
