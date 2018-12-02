<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/12/2
 * Time: 11:04 AM
 */
require_once MODEL_PATH."Medoo.php";
use Medoo\Medoo;



class DBStoreState
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

    //查看商家的状态 ，是营业还是休息
    public function checkOpen($store_id){
        $data = $this->database->select('StoreStateTable',['open'],['store_id'=>$store_id]);
        if($data[0]['open'])
        {
            return 1;  //商家正在营业
        }
        else
        {
            return 0;  //商家休息
        }
    }
    //商家开始营业
    public function setStore($store_id){
        $data = $this->database->insert('StoreStateTable',['store_id'=>$store_id,'open'=>0]);
        $num = $data->rowCount();
        if ($num == 1)
            return "ok";
        else if($num == 0)
            return "no effect";
        else
            return "open failed";

    }
    //商家开始营业
    public function openStore($store_id){
        $data = $this->database->update('StoreStateTable',['open'=>1],['store_id'=>$store_id]);
        $num = $data->rowCount();
        if ($num == 1)
            return "ok";
        else if($num == 0)
            return "no effect";
        else
            return "open failed";

    }

    //商家休息，并清空排队队列
    public function closeStore($store_id){
        $data = $this->database->update('StoreStateTable',['open'=>0],['store_id'=>$store_id]);
        $num = $data->rowCount();
        if ($num == 1)
            return "ok";
        else if($num == 0)
            return "no effect";
        else
            return "close failed";

        $clear = $this->database->delete('QueueTable',['store_id'=>$store_id]);
        $num = $clear->rowCount();
        if ($num > 0)
            return "ok";
        else if($num == 0)
            return "no effect";
        else
            return "clear failed";

    }
}