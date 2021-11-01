<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type:application/json;charset=UTF-8");
    header("Access-Control-Allow-Methods:POST,GET,PUT,DELETE");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

    // get database connection
    include_once '../config/database.php';
    // instantiate product model 
    include_once '../model/Produk.php';
     
    //Connection to database
    $database = new Database();
    $db = $database->getConnection();
 
    //create object produk 
    $produk = new Produk($db);
    //get request method from client 
    $request = $_SERVER['REQUEST_METHOD'];
 
    //check request method client
    switch($request)
    {
        case 'GET' :
        //code if the client request method GET
             
        break;
 
        case 'POST' :
        //code if the client request method is POST
         
        break;
 
        case 'PUT' :
        //code if the client request method is PUT
            //codeiftheclientrequestmethodisPUT
             
        break;
 
        case 'DELETE' :
        //code if the client request method is DELETE
            //codeiftheclientrequestmethodisDELETE
        
        break;
 
        default :
        //code if the client request is not GET ,POST ,PUT ,DELETE 
        http_response_code(404);
 
        echo "Request tidak diizinkan";
    }
?>