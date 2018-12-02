<?php
/**
 * Created by PhpStorm.
 * User: v1cky
 * Date: 2018/12/1
 * Time: 4:24 PM
 */
require_once MODEL_PATH."Medoo.php";

use Medoo\Medoo;
class DBQueue
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

    //插入排队信息
    public function insertQueueInfo($store_id,$customer_id)
    {
        $data = $this->database->insert('QueueTable',['store_id'=>$store_id,'customer_id'=>$customer_id]);
        $num = $data->rowCount();
        if ($num == 1)
            return 1;
        else
            return -1; //insert failed
    }

    public function callNumber($store_id){
        $data = $this->database->select('QueueTable',['customer_id','id'],['store_id'=>$store_id]);
        $num = $data->rowCount();
        if($num > 1){
            $data = $this->database->delete('QueueTable',['id'=>$data[0]['id']]);
            return $data[1]['customer_id'];
        }
        else{
            return -1; //排队队列已空
        }
    }

    public function callRepeatNumber($store_id){
        $data = $this->database->select('QueueTable',['customer_id'],['store_id'=>$store_id]);
        $num = $data->rowCount();
        if($num > 0){
            return $data[0]['customer_id'];
        }
        else{
            return -1; //排队队列已空
        }
    }

    public function cancelQueue($customer_id,$store_id){
    //"ORDER" => ["item.id"=>"DESC"
        $data = $this->database->select('QueueTable',['id'],['AND'=>[
            'customer_id'=>$customer_id,
            'store_id'=>$store_id],
            'ORDER'=>['id'=>'DESC']]
        );
        $num = $data->rowCount();
        if($num > 0){
            $data = $this->database->delete('QueueTable',['id'=>$data[0]['id']]);
            $num = $data->rowCount();
            if($num)
                return 0;  //success to cancel queue
            else
                return -2; //failed to cancel queue
        }
        else{
            return -1; //排队队列已空
        }
    }

    //获取当前商家的排队队列
    public function getQueue($store_id)
    {
        $data = $this->database->select('QueueTable',['customer_id'],['store_id'=>$store_id]);
        return $data;

    }

    //获取该商家当前排队人数
    public function getNumber($store_id)
    {
        $data = $this->database->select('QueueTable',['customer_id'],['store_id'=>$store_id]);
        $num = $data->rowCount();
        return $num;

    }

}