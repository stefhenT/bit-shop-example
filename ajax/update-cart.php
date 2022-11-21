<?php
include realpath(__DIR__."/../library.php");

if(session_id()=="")
    session_start();

if(!isset($_SESSION["cart"]))
    $_SESSION["cart"]=Cart::Singleton();


/**
 * @var Cart $cart
 * */  

 $cart=$_SESSION["cart"];

 $product=MP_GretItemById($_POST["id"]);
 $cartItem=new CartItem($product,$_REQUEST["jumlah"]);

 $cart->UpdateItem($cartItem);
 $return=[
    "code"=>"OK",
    "status"=>true,
    "message"=>"Update"
 ];

 header("content-type:application/json");
 echo json_encode($return);

?>

