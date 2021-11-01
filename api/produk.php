<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type:application/json;charset=UTF-8");
    header("Access-Control-Allow-Methods:POST,GET,PUT,DELETE");
    header("Access-Control-Max-Age:3600");
    header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

    // get database connection
    include_once '../config/database.php';
    // instantiate product model 
    include_once '../model/produk.php';
     
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
 
        if(!isset($_GET['id'])){
            $stmt=$produk->read();
            $num = $stmt->rowCount();
         
            // check if more than 0 record found
            if($num>0){
                //products array
                $produks_arr=array();
                $produks_arr["records"]=array();
         
                // retrieve our table contents
                // fetch() is faster than fetch All()
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    // extract row 
                    // this will make $row['name']to
                    // just $name only
                    extract($row);
         
                    $produk_item=array(
                        "id" => $id,
                        "nama_produk" => $nama_produk,
                        "harga" => $harga,
                        "tipe_produk" => $tipe_produk,
                        "stok" => $stok
                    );
                    array_push($produks_arr["records"], $produk_item);
                }
                // set response code-200 OK 
                http_response_code(200);
         
                // show products data in json format 
                echo json_encode($produks_arr);
            }else{
                // no products found will be here
                // set response code - 404 Not found
                http_response_code(404);
         
                //tell the user no products found 
                echo json_encode(
                    array("message" => "No products found.")
                );
            }
        }
        elseif($_GET['id'] == NULL){
          echo json_encode(array("message" => "Parameter Id id tidak boleh kosong")); 
        }else{

            //set ID property of record to read 
            $produk->id=$_GET['id'];
         
            // read the details of product to be edited
            $produk->readOne();
         
            if($produk->id!=null){
                //create array
                $produk_item=array(
                    "id" => $produk->id,
                    "nama_produk" => $produk->nama_produk,
                    "harga" => $produk->harga,
                    "tipe_produk" => $produk->tipe_produk,
                    "stok" => $produk->stok
                );
         
                //set response code- 200 OK 
                http_response_code(200);
         
                //make it json format 
                echo json_encode($produk_item);
            }else{
                //set response code-404 Not found 
                http_response_code(404);
         
                //tell the user product does notexis 
                echo json_encode(array("message" => "Productdoesnotexist."));
            }
        }


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