<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/11/29
 * Time: 9:16 AM
 */

session_start();
require_once MODEL_PATH."DBInfoCustomer.php";
require_once MODEL_PATH."DBInfoStore.php";
header("Content-Type: text/html; charset=utf-8");
//    header("Access-Control-Allow-Origin:*");

$teamName = $_POST['username'];
$password = $_POST['password'];
$flag = $_POST['flag'];
$json = '';

//username不能为空
if($username==null || $username==""){
    $json = '{"state":"username cant be null"}';
    echo $json;
    return ;
}


//密码不能为空
if($password==null || $password==""){
    $json = '{"state":"password cant be null"}';
    echo $json;
    return ;
}

//密码长度不能超过20位
if(strlen($password)>20){
    $json = '{"state":"length of password must shorter than 20 chars"}';
    echo $json;
    return ;
}

//password不要包含特殊字符' " \ ;
if(strstr($password,"'") || strstr($password,"\"") || strstr($password,";") || strstr($password,"\\")){
    $json = '{"state":"special chars in password"}';
    echo $json;
    return ;
}



//用户是顾客 , flag=1
if($flag){
    $check = new DBInfoCustomer();
    $result = $check->validate($username,md5($password));
    if($result){
        $_SESSION['customer'] = $username;
        $id = $check->getIdByName($username);
        $_SESSION['customer_id'] = $id;
        $json = '{"state":"ok"}';
        echo $json;
        return ;
    }
    else{
        mylog('log: user:'.$userame.' login failed!withpass:'.$_POST['password']);
        $json = '{"state":"wrong username or password"}';
        echo $json;
        return ;
    }

}
elseif($result){ //用户是商家 flag=0
    $check = new DBInfoStore();
    $result = $check->validate($username,md5($password));
    if($result){

        $_SESSION['store'] = $username;
        $id = $check->getIdByName($username);
        $_SESSION['store_id'] = $id;
        $json = '{"state":"ok"}';
        echo $json;
        return ;
    }
    else{
        mylog('log: user:'.$userame.' login failed!withpass:'.$_POST['password']);
        $json = '{"state":"wrong username or password"}';
        echo $json;
        return ;
    }

}
else{
    $json = '{"state":"wrong flag"}';
    echo $json;
    return ;
}

?>
