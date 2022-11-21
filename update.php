<?php 
include_once __DIR__."/library.php";
session_start();
$data=MP_GEData();
$pid=$_REQUEST["pid"];
$index=array_indexOf($data,function($d) use($pid)
{
    return $d->id==$pid;
});    

if(isset($_REQUEST["update_data"]))
{
    MP_UpdateData($_REQUEST["updt_name"],$_REQUEST["updt_price"],$index);
    print("<h2>"."Update Succes"."</h2>");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Update</title>
</head>
<body>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>PRICE</td>
                    </tr>
                </thead>
                <tbody>
                    <?php print("<tr>");?>
                        <?php print("<td>".$data[$index]->id."</td>"); ?>
                        <?php print("<td>".$data[$index]->name."</td>"); ?>
                        <?php print("<td>".$data[$index]->price."</td>"); ?>
                    <?php print("</tr>");?>
                </tbody>
            </table>
            <form method="POST">
                    <label>Name</label><input type="text" name="updt_name"><br>
                    <label>Price</label><input type="text" name="updt_price"><br>
                    <button type="submit" name="update_data">Update</button>
                    <button  type="button"><a href="master/product_index.php" style="text-decoration: none; color:black;">Back</a></button>
            </form>
</body>
</html>