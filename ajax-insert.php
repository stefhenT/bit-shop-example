<?php
include_once __DIR__."/library.php";

try{

    if(!is_numeric($_REQUEST["pprice"])) 
        throw new Exception("Price bukan angka",1);
    
    if($_REQUEST["pid"]==""or$_REQUEST["pid"]==null)
        throw new Exception("ID barang tidak boleh kosong",2);
    $result=MP_AddData($_POST);

    header("content-type: application/json");
    if($result>0)
    {
            echo json_encode(["message"=>"Berhasil insert data"]);
    }
    else
    {
        echo json_encode(["message"=>"Gagal insert data"]);
    }
}
catch(Exception $e){
    http_response_code(400);
    echo json_encode(["message"=>"Gagal insert data:{$e->getMessage()}!"]);
}







?>