<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <title> Sign up </title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class ="container">
        <?php
            if(isset($_POST["submit"])){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $password_Hash = password_hash($password, PASSWORD_BCRYPT);
            ///$password_Hash = $password;
            $errors = array();

            if(empty($email) OR empty($password)){
                array_push($errors,"All field are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if(strlen($password)<8){
                array_push($errors, "Password should be at least 8 characters");
            }
            
            require_once "sendingdata.php";

            $sql ="SELECT * FROM registered WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);

            if($rowCount>0){
                array_push($errors, "Email is already exist!");
            }
            if(count($errors)>0){        
                foreach($errors as $error){
                    echo"<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
                $sql = "INSERT INTO registered (email, password) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                $preparedStmt = mysqli_stmt_prepare($stmt,$sql);
                if($preparedStmt){
                    mysqli_stmt_bind_param($stmt,"ss",$email,$password_Hash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registed successfully</div>";
                }
                else{
                    die("Something went wrong");
                }
            }
        }

        ?>
        <form action="signup.php" method = "post">

            <div style="margin:0 auto;">
                <h2 style=" font:arial; font-color:Black; text-align:center;"> Signup</h2>
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

            <a href="signin.php">signin</a>
            <a href="signupDM.php">darkmode</a>
        </form>
    </div>
</body>
</html>

