<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:22 AM
 */


	session_start();
    require_once MODEL_PATH."DBInfoCustomer.php";
 	header("Content-Type: text/html; charset=utf-8");
	if(!isset($_SESSION['customer_id']))
    {
        $msg = array('state' => 'nologin');
        die(json_encode(($msg)));
    }

    $customer_id = $_SESSION['customer_id'];

	if(!isset($_POST['info'])){
        $msg = array('state' => 'what r u doing ?');
        die(json_encode(($msg)));


    }elseif($_POST['info'] == 'info'){
        $password = $_POST['password'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        //phone为11位数字
        if(!preg_match('/^\d\d{9}\d$/',$phone)){
            $msg = array('state' => 'phone number error');
            die(json_encode(($msg)));
        }

        //username
        if($username==null || $username==""){
            $msg = array('state' => 'username cannot be null');
            die(json_encode(($msg)));
        }
        //username
        if(strlen($username)>30){
            $msg = array('state' => 'the length of username should be less than 30');
            die(json_encode(($msg)));
        }
        //username 不包含特殊字符' " \ ; < >
        if(strstr($username,"'") || strstr($username,"\"") || strstr($username,";") || strstr($username,"\\") || strstr($username,"<") || strstr($username,">")){
            $msg = array('state' => 'username cannot include special char');
            die(json_encode(($msg)));
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


        //edit store infomation
        $userchk = new DBInfoCustomer();
        $result = $userchk->editCustomerInfo($customer_id,$password,$username,$phone,$email);
        if($result=="failed"){
            $json = '{"state":"failed"}';
            echo $json;
            return ;
        }else if($result == 'ok'){
            $json = '{"state":"ok"}';
            echo $json;
            return ;
        }else if($result == 'no effect'){
            $json = '{"state":"no effect"}';
            echo $json;
            return ;
        }else if($result = "Auth failed"){
            $json = '{"state":"Auth failed"}';
            echo $json;
            return ;
        }else{
            die('{"state":"unknow error"}');
        }



    }elseif($_POST['info'] == 'passwd'){

        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];


        //密码不能为空
        if($newpassword==null || $newpassword==""){
            $msg = array('state' => 'password cannot be null');
            die(json_encode(($msg)));
        }
        //密码长度不能超过20位
        if(strlen($newpassword)>20){
            $msg = array('state' => 'the length of username should be less than 20');
            die(json_encode(($msg)));
        }
        //password不要包含特殊字符' " \ ;
        if(strstr($newpassword,"'") || strstr($newpassword,"\"") || strstr($newpassword,";") || strstr($newpassword,"\\")){
            $msg = array('state' => 'password should not include spceial char');
            die(json_encode(($msg)));
        }
        //password与newpassword不同
        if($newpassword == $password){
            $msg = array('state' => 'the same password');
            die(json_encode(($msg)));
        }

        //edit user infomation
        $userchk = new DBInfoCustomer();
        $result = $userchk->updatePassword($customer_id,$password,$newpassword);
        if($result=="failed"){
            $json = '{"state":"failed"}';
            echo $json;
            return ;
        }else if($result == 'ok'){
            $json = '{"state":"ok"}';
            echo $json;
            return ;
        }else if($result == 'no effect'){
            $json = '{"state":"no effect"}';
            echo $json;
            return ;
        }else if($result = "Auth failed"){
            $json = '{"state":"Auth failed"}';
            echo $json;
            return ;
        }else{
            die('{"state":"unknow error"}');
        }

    }else{
        $msg = array('state' => 'I dont understand U');
        die(json_encode(($msg)));
    }

?>