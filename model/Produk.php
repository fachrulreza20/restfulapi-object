<?php 
    Class Produk{
 
        //database connection and table name
        private $conn;
        private $table_name = "produk";
 
        // object properties
        public $id;
        public $nama_produk;
        public $harga;
        public $tipe_produk;
        public $stok;
 
        // constructor with $db as database connection
        public function __construct($db)
        {
            $this->conn = $db;
        }
 
        // read all products
        function read(){

            $query = "SELECT id, nama_produk, harga, tipe_produk, stok
                      FROM ".$this->table_name."
                      ORDER BY id ASC";

           //prepare query statement
           $stmt = $this->conn->prepare($query);
 
           // execute query
           $stmt->execute();
           return $stmt;

            
        }
 
        // read single products by id
        function readOne(){

            $query = "SELECT
            id, nama_produk, harga, tipe_produk, stok
            FROM
            " . $this->table_name . "
            WHERE
            id = ?";


            //prepare query statement
            $stmt = $this->conn->prepare($query);
 
            // bind id of product to be updated
            $stmt->bindParam(1, $this->id);
 
            // execute query
            $stmt->execute();
 
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
            //set values to object properties
            $this->nama_produk = $row['nama_produk'];
            $this->harga=$row['harga'];
            $this->tipe_produk=$row['tipe_produk'];
            $this->stok=$row['stok'];
            
        }
 
        //create products
        function create(){
         
            //query to insert record
            $query = "INSERT INTO
            " . $this->table_name . "
            SET
                nama_produk=:nama_produk,
                harga=:harga,
                tipe_produk=:tipe_produk,
                stok=:stok";
 
            // prepare query
            $stmt = $this->conn->prepare($query);
 
            // bind values 
            $stmt->bindParam(":nama_produk", $this->nama_produk);
            $stmt->bindParam(":harga", $this->harga);
            $stmt->bindParam(":tipe_produk", $this->tipe_produk);
            $stmt->bindParam(":stok", $this->stok);
 
            //execute query 
            if($stmt->execute())
            {
            return true;
            }
            return false;


        }
 
        //update the product
        function update(){
            //updatequery

            $query= "UPDATE
            " . $this->table_name . "
            SET
            nama_produk = :nama_produk,
            harga = :harga,
            tipe_produk = :tipe_produk,
            stok = :stok
            WHERE
            id = :id";
 
            //preparequerystatement
            $stmt = $this->conn->prepare($query);
 
            //bindnewvalues
            $stmt->bindParam(':nama_produk', $this->nama_produk);
            $stmt->bindParam(':harga', $this->harga);
            $stmt->bindParam(':tipe_produk', $this->tipe_produk);
            $stmt->bindParam(':stok', $this->stok);
            $stmt->bindParam(':id', $this->id);
 
            //executethequery
            if($stmt->execute()){
            return true;
            }
 
            return false;

        }
 
        // detela the products
        function delete(){

        //deletequery
             $query = "DELETE FROM "
             . $this->table_name . 
             " WHERE id = ?";
         
             //prepare query
             $stmt = $this->conn->prepare($query);
         
             //sanitize//$this->id=htmlspecialchars(strip_tags($this->id));
         
             //bindidofrecordtodelete
             $stmt->bindParam(1,$this->id);
         
             //executequery
             if($stmt->execute()){
                 return true;
             }
             return false;
             }
        
        }
}
?>