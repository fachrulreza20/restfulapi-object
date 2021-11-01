<?php
    class Database{

    private $host = "localhost"; 
    private $db_name = "restfullapi-object";
    private $username ="root"; 
    private $password ="";
    public $conn;

    //get the data base connection 
    public function getConnection(){
        $this->conn = null;
        try{
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->conn->exec("set names utf8");
    }catch(PDOException $exception){
        echo "Connectionerror:" . $exception->getMessage();
    }return $this->conn;
    }
}
?>