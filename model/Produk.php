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
            
        }
 
        // read single products by id
        function readOne(){
            
        }
 
        //create products
        function create(){
         
         }
 
        //update the product
        function update(){
            //updatequery
             
        }
 
        // detela the products
        function delete(){
            //deletequery
        
        }
}
?>