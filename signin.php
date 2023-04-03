<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <title> Sign in </title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class ="container">
        <?php
        if(isset($_POST["submit"])){
            $email = $_POST["email"];
            $password1 = $_POST["password"];


            require_once "sendingdata.php";
            $sql = "SELECT * FROM registered WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if($user){
            if (password_verify($password1, $user["password"])){
                header("Location: index.php");
                die();
            }else{
                echo"<div class='alert alert-danger'> Email and Password does not match</div>";
            }
            }else{
                echo"<div class='alert alert-danger'> Email and Password does not match</div>";
            }
        
    }       

        ?>


        <form action="signin.php" method="post">
            <div style="margin:0 auto;">
                <h2 style=" font:arial; font-color:Black; text-align:center;"> Sign in</h2>
            </div> 

            <div class="form-group">
                <input type="text" id="box" name="email" placeholder="Email: ">
            </div>

            <div class="form-group">
                <input type="password" id="box" name="password" placeholder="Password: ">
            </div>

            <div class = "form-group">
                <input type="submit" id="submit" value="Register" name="submit">
            </div>
            <a href="signup.php"> signup</a>
        </form>
    </div>
</body>
</html>