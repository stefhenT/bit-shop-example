<?php
//This file will contain all out function
// Example we will put loginCheckredirect()
include_once __DIR__."/dto.php";
include_once __DIR__."/conn.php"; //The connection

function loginCheckredirect():void
{
    if(session_id()=="")//If it's blank, start the session
        session_start();

    //This is to check if we are already login
    if(!isset($_SESSION["user"]))
    {
        header("Location: /BackEnd-lab/P-07/index.php");
        exit;
    }
}

function MP_GEData():array
{
    /**  @var \PDO $db */
    global $db; // This declare $db in conn.php

    $data=[]; //Init the data!

    //Prepare query
    $query="SELECT * FROM product";
    $temp=$db->query($query);
    
    foreach($temp as $k=>$d)
    {
        $data[]=new Product($d["id"],$d["name"],$d["price"]);
    }
   var_dump($data);
    return $data;
}

function MP_AddData($payload) : int
{

    /**  @var \PDO $db */
    global $db; // This declare $db in conn.php
    $success=0;
    // if the are post
 
    //if not we can proceed

    $d=new Product($payload["pid"],$payload["pname"],$payload["pprice"]);

    $query="INSERT INTO product(id,name,price) values (:pid,:pname,:pprice)";
    $stmt=$db->prepare($query);// Prepare the string 
    //To handle the erorr
    unset($payload["btnInsertProduct"]);
    //or you can create a new earray based on the payload!
    //var_dump($payload);

  //  $success=$stmt->execute(["pid"=>$payload["pid"],"pname"=>$payload["pname"],"pprice"=>$payload["pprice"]]);//Add data
    $success=$stmt->execute($payload);//Change to one when it's succesful!

    return $success;
}

function MP_DeleteData($pid)
{
      /**  @var \PDO $db */
      global $db; // This declare $db in conn.php

    $status=0;
    $query="DELETE FROM product WHERE id=:id";  
    $stmt=$db->prepare($query);
    $status=$stmt->execute(["id"=>$pid]);
    
    return $status;

  
}

function array_indexOf($array,$callback)
{
    $found=-1;
    foreach($array as $key=>$val)
    {
        if($callback($val)==true)
        {
            $found=$key;
        }
    }

    return $found;
}


function MP_SearchData($q)
{
          /**  @var \PDO $db */
          global $db; // This declare $db in conn.php

          $data=[];

          $query="SELECT * FROM product WHERE name LIKE :name OR id LIKE :id";
          $stmt=$db->prepare($query);
          $stmt->execute(["id"=>"%$q%","name"=>"%$q%"]);

            $temp=$stmt->fetchAll();

           foreach($temp as $k=>$d)
           {
             $data[]=new Product($d["id"],$d["name"],$d["price"]);
           }
        return $data;
}

function MP_UpdateData($pid,$payload)
{
       /**  @var \PDO $db */
       global $db; // This declare $db in conn.php

       $status=0;
       $query="UPDATE product SET id=:newID, name=:name, price=:price WHERE id=:oldID";
       $stmt=$db->prepare($query);
       $success=$stmt->execute(["oldID"=>$pid,"newID"=>$payload["pid"],"name"=>$payload["pname"],"price"=>$payload["pprice"]]);
       return $status;
}







/**
 * 
 * @param string $id 
 * @return Product | null
 * @throws PDOException 
 */

function MP_GretItemById(string $id)
{
    $data=MP_SearchData($id);
    if(count($data)<=0)
        return null;
    
    return $data[0];
}


?>