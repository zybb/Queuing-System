<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/12/1
 * Time: 4:24 PM
 */
require_once MODEL_PATH."Medoo.php";

use Medoo\Medoo;

class DBInfoStore
{


    private $database;

    public function __construct(){
        $this->database = new Medoo(array(
            'database_type' => MYSQL_TYPE,
            'database_name' => DBNAME,
            'server' => HOST,
            'username' => DBUSER,
            'password' => DBPWD,
            'charset' => 'utf8'
        ));
    }


    //顾客登录时认证
    public function  validate($username,$pass)
    {
        $data = $this->database->select('StoreInfoTable',['password'],['username'=>$username]);
        if($pass == $data[0]['password'])
        {
            return 1;  //认证成功
        }
        else
        {
            return 0;  //认证失败
        }

    }

    //判断密码是否正确
    public function checkByTid($store_id,$password)
    {
        $data = $this->database->select('StoreInfoTable',['password'],['store_id'=>$store_id]);
        if($data[0]['password'] == $password)
        {
            return 1;
        }
        else
        {
            return -1;
        }
    }

    //更改顾客密码
    public function updatePassword($store_id,$password,$newPassword)
    {
        $result = $this->checkByTid($store_id,$password);
        if($result)
        {
            $data = $this->database->update('StoreInfoTable',['password'=>$newPassword],['store_id' => $store_id]);
            $num = $data->rowCount();
            if ($num == 1)
                return "ok";
            else if($num == 0)
                return "no effect";
            else
                return "update failed";

        }
        else
        {
            return "auth failed";
        }

    }

    //通过顾客名称得到顾客ID
    public function getIdByName($username)
    {
        $data = $this->database->select('StoreInfoTable',['store_id'],['username'=>$username]);
        $num = $data->rowCount();
        if($num == 0){
            return 0;
        }else{
            return $data[0]['store_id'];
        }


    }

    //更新用户个人信息
    public function editCustomerInfo($store_id,$password,$username,$phone,$email)
    {
        $result = $this->checkByTid($store_id,$password);
        if($result)
        {
            $data = $this->database->update('StoreInfoTable',['username'=>$username,'phone'=>$phone,'email'=>$email],['store_id' => $store_id]);
            $num = $data->rowCount();
            if ($num == 1)
                return "ok";
            else if($num == 0)
                return "no effect";
            else
                return "update failed";

        }
        else
        {
            return "auth failed";
        }

    }

    //添加新顾客用户
    public function addStore($username,$password,$email,$phone,$describe)
    {
        $result = $this->getIdByName($username);
        if($result == 0 ){
            $data = $this->database->insert('StoreInfoTable',['username'=>$username,'password'=>$password,'phone'=>$phone,'email'=>$email,'describe'=>$describe]);
            $num = $data->rowCount();
            if ($num == 1)
                return 1;
            else if($num == 0)
                return 0;
            else
                return -1;
        }else{
            return -2; //store already exists
        }

    }

}