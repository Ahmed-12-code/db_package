<?php

namespace Createivo\Db;

class dp {


  private $conn ; 
  private $table;
  private $sql ; 
  public function __construct($host  ,$user  ,$pass , $db , $table){
    $this->conn=mysqli_connect($host , $user , $pass ,$db);
    $this->table=$table;
  }

  public function select($columns = "*"){
    $this->sql = "select $columns from $this->table ";
    return $this;
  }
  public function insert($data){
    $st1=""; 
    $st2="";
    foreach($data as $key => $value){
      $st1.="$key,";
      $st2.="'$value',";
    }
    $st1 = rtrim($st1  , ',');
    $st2 = rtrim($st2  , ',');
    $this->sql = "insert into $this->table ($st1) values ($st2) ";

    return $this ; 
  }
  public function update($updatedData){
    $this->sql= "update $this->table set ";
    foreach($updatedData as $k => $v){
      $this->sql.="$k = '$v', ";
    }
    $this->sql=rtrim("$this->sql" , ', ');
    
    return $this;
  }
  public function delete(){
    $this->sql.="delete from $this->table";
    return $this;
  }
  public function execute(){
    mysqli_query($this->conn , $this->sql);
    echo mysqli_affected_rows($this->conn);
  }
  public function all(){
    $data = mysqli_query($this->conn , $this->sql);
    echo "<pre>";
    print_r(mysqli_fetch_all($data , MYSQLI_ASSOC));
  }

  public function condition($cond){
    
      $this->sql.="where $cond";
    
      return $this;
    

  }
} 