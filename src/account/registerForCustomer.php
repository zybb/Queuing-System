<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:18 AM
 */

    session_start();
    require_once MODEL_PATH."DBInfoCustomer.php";
 	header("Content-Type: text/html; charset=utf-8");

 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	$rePassword = $_POST['rePassword'];
 	$email = $_POST['email'];
 	$phone = $_POST['phone'];

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



 	$check = new DBInfoCustomer();
 	$result = $check->addCustomer($username,$password,$email,$phone);
 	if($result==-2){
 		$json = '{"state":"user already exists"}';
 		echo $json;
 		return ;
 	}else if($result>0){
 		$_SESSION['customer'] = $username;
 		$json = '{"state":"ok"}';
 		echo $json;
 		return ;
 	}else{
 		$json = '{"state":"stmt error"}';
 		echo $json;
 		return ;
 	}

 ?>
