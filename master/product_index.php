<?php

// echo __DIR__;
  //  echo "<br>";
    include_once __DIR__."/../library.php";
  //  echo realpath(__DIR__."/../library.php")."<br/>";
   // echo realpath(__DIR__."/../../")."<br/>";

   loginCheckredirect();
    $msg="";//init msg
   //Loading data from array
   
   if(isset($_REQUEST["btnInsertProduct"]))
   {
        $result=MP_AddData($_REQUEST);
        if($result==1)
            $msg="Succes add product";
        else
            $msg="Error add product";
   }

   if(isset($_REQUEST["btnDeleteProduct"]))
   {
    $result=MP_DeleteData($_REQUEST["pid"]);
        if($result==1)
            $msg="Succes delete product";
        else
            $msg="Error delete";
   }
   $data=MP_GEData();

   if(isset($_REQUEST["srch"]))
   {
        $find=$_REQUEST["srch"];
        
        $data=MP_SearchData($find);
   }

   if(isset($_REQUEST["btnUpdateProduct"]))
   {
      $result=MP_UpdateData($_POST["old_id"],$_POST);
      if($result==1)$msg="Succer update product";
      else $msg="erorr";
   }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/BackEnd-lab/P-07/style.css">
    <title>Master Product</title>
</head>
<body>
<div class="nav_bar">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link fw-light" href="/BackEnd-lab/P-07/home.php" >Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  fw-bold" href="master/product_index.php">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-light" href="#">About</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
       <h1>Master Product</h1>
       <?= "<h3>$msg</h3>"?>

    <div class="container">
            <form method="POST">
                <label>ID</label>
                <input type="text" name="pid" id="pid"><br>
                <label>NAME</label>
                <input type="text" name="pname" id="pname"><br>
                <label>Price</label>
                <input type="text" name="pprice" id="pprice"><br>
                <button name="btnInsertProduct" value="1">Insert</button><br><br>

                
            </form>
    
            <form >
            <input type="text" name="srch" id="srch">
                <button type="submit">Search</button>
            </form>
    
       <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                        <?php foreach($data as $d):?>
                            <tr>
                                <td><?= $d->id ?></td>
                                <td><?= $d->name ?></td>
                                <td><?= $d->price ?></td>
                                <td>
                                  <form method="POST">
                                      <a href="?edit_id=<?= $d->id ?>">EDIT</a>
                                      <input type="hidden" name="pid" value="<?= $d->id?> ">
                                      <button type="submit" name="btnDeleteProduct">Delete</button>
                                  </form>
                                </td>
                            </tr>
                                  <?php if(isset($_GET["edit_id"])):?>
                                    
                                      <?php if($_GET["edit_id"]==$d->id):?>
                                    <tr>
                                        <td colspan="4" action="product_index.php">
                                          <form method="POST">
                                              <label>ID</label>
                                              <input type="text" name="pid" id="pid" value=" <?= $d->id?>"><br>
                                              <input type="hidden" name="old_id" value=" <?= $d->id?>">
                                              <label>NAME</label>
                                              <input type="text" name="pname" id="pname" value=" <?= $d->name?>"><br>
                                              <label>Price</label>
                                              <input type="text" name="pprice" id="pprice" value=" <?= $d->price?>"><br>
                                              <button name="btnUpdateProduct" value="1">Insert</button><br><br>

                      
                                            </form>
                                              <a href="product_index.php">Clear</a>
                                          </td>
                                    </tr>
                                      <?php endif;?>
                                  <?php endif;?>
                              <?php endforeach;?>

                </tbody>

                </table>
    </div>
</body>
</html>