<?php

if(isset($_COOKIE["remember"]))
{
    session_start();
    $_SESSION["user"]=$_COOKIE["remember"];
   $_SESSION["msg"] ="Berhasil login";
        setcookie("remember",$_COOKIE["remember"],time()+24*7*3600);
    header("Location: catalog.php");
    exit;
}

$msg=(isset($_GET["msg"]))?$_GET["msg"] : "";

    if(isset($_POST["btnLogin"]))
    {
        session_start(); //Start a session
        if($_POST["user"]=="admin"&&$_POST["password"]=="admin")
        {
            $_SESSION["user"]=$_POST["user"];
            $msg="Berhasil login";
            if(isset($_POST["remember"]))
            {
                setcookie("remember",$_POST["user"],time()+24*7*3600);
            }
            header("Location: catalog.php");
            exit;
        }
        else
        {
            $msg="Uh oh, your user or pass is wrong";
        }
    }
    


    if($msg!="")
    {
        $msg="<h3>".$msg."</h3>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
    <body>
        <!-- <form method="post">
            <h2>Login Page</h2>
            User : <input type="text" name="user"><br>
            Password: <input type="password" name="password"><br>
            <input type="checkbox" name="remember" value="1">Remember Me<br>
            <button name="btnLogin"  value="1" type="submit">Login</button>        
        </form> -->

            <div class="login_form">
                <form method="POST">
                        <?= $msg ?>
                    <!-- Username input -->
                    <div class="form-outline mb-4">
                    <input type="text" id="form2Example1" class="form-control" name="user"/>
                    <label class="form-label" for="form2Example1">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                    <input type="password" id="form2Example2" class="form-control" name="password" />
                    <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="form2Example31" checked name="remember" />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="btnLogin" value="1" class="btn btn-primary btn-block mb-4">Login</button>


                </form>
            </div>
    </body>
</html>

