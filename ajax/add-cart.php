<?php
include realpath(__DIR__."/../library.php");

 if(session_id()=="")
      session_start();

if(isset($_SESSION["user"]))
{

    print("<h1>ON</h1>");
    if(!isset($_SESSION["cart"]))
    $_SESSION["cart"]=Cart::Singleton();


/**
 * @var Cart $cart
 * */  
$return=[];
 $cart=$_SESSION["cart"];

 $product=MP_GretItemById($_REQUEST["id"]);
 $cartItem=new CartItem($product,$_REQUEST["jumlah"]);

 $cart->Additem($cartItem);
 $return=[
    "code"=>"OK",
    "status"=>true,
    "message"=>"Berhasil tambah Cart"
        ];



 header("content-type:application/json");
 
 echo json_encode($return);
}
else
{
    $return=[
        "code"=>"OK",
        "status"=>false,
        "message"=>"Anda harus login dahulu"
            ];

    header("content-type:application/json");
    echo json_encode($return);
}


?>