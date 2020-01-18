<?php

namespace app\models;


use Illuminate\Database\Eloquent\Model;
use PDO;
use PDOException;

class CommonModel extends Model
{
    public $table;
    public $db;

//    public function __construct()
//    {
//        try{
//            $this->db = new PDO("mysql:dbname=issues; host=localhost; charset=UTF8", "root", "root");
//            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//        } catch (PDOException $e){
//            echo $e->getMessage();
//            exit;
//        }
//    }

//    public function getAll(){
//
//        $sql = "SELECT * FROM {$this->table}";
//
//        $stmt = $this->db->prepare($sql);
//        $stmt->execute();
//
//        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        return $res;
//    }

//    public function slice($start, $itemsPerPage){
//        $sql = "SELECT * FROM {$this->table} LIMIT {$start}, {$itemsPerPage}";
//        $stmt = $this->db->prepare($sql);
//        $stmt->execute();
//
//        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//        return $res;
//    }

//    public function countRow(){
//        $sql = "SELECT COUNT(*) as countrows FROM {$this->table}";
//        $stmt = $this->db->prepare($sql);
//        $stmt->execute();
//        $res = $stmt->fetch(PDO::FETCH_BOTH);
//
//        return $res['countrows'];
//    }

}