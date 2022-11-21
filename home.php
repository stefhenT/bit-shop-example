<?php
session_start();
$msg=(isset($_SESSION["msg"]))?$_SESSION["msg"] : "";


if(!isset($_SESSION["user"]))
{
    header("Location: index.php");
    exit;
}
if($msg!="")
$msg="<h1>".$msg."</h1>";

?>

<?php
    unset($_SESSION["msg"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Home</title>
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
                  <a class="nav-link fw-bold" href="home.php" >Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  fw-light" href="master/product_index.php">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-light" href="#">About</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        <?php print("<h3>"."Welcome"." ".$_SESSION["user"]."</h3>");?>
       <a href="logout.php">Logout</a>
</body>
</html>