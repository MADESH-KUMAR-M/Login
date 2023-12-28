<?php

$host = "localhost";
$user = "root";
$password  = "";
$db ="test";

$nameerr = $mailerr = $passerr = "";
$name = $email = $pass = "";
$conn = mysqli_connect($host, $user , $password , $db);

$sql = $conn->prepare("INSERT INTO login(user,email,password) VALUES(?,?,?)");
$sql->bind_param("sss",$name,$email,$pass);

$flag = true;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["uname"])){
        $nameerr = " * THIS FIELD IS REQUIRED";
        $flag = false;
    }else{
        $name = $_POST["uname"];
    }
    if(empty($_POST["email"])){
        $mailerr = " * THIS FIELD IS REQUIRED";
        $flag = false;
    }else{
        $email = $_POST["email"];
    }
    if(empty($_POST["pass"])){
        $passerr = " * THIS FIELD IS REQUIRED";
        $flag = false;
    }else{
        $pass = $_POST["pass"];
    }

    if($flag){
        $sql->execute();
        $id = $conn->insert_id;
        echo "<script>alert('Account created successfully');window.location.href = 'index.php';</script>";
    }
}
?>
<html>
    <head>
        <title>
            SIGNUP PAGE
        </title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width">
        <style>
            .error{
                color: red;
                font-size: xx-small;
                z-index: 100;
                position: absolute;
                width: 50px;
            }
            </style>
    </head>
    <body background="bg.webp">
            <div class="login">
            <h1>SIGNUP</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <label>Enter your username</label>
            <input type="text" id="name" name="uname">
            <span class="error" style="color: red;"><?php echo $nameerr ?> </span>
            <label>Enter your email</label>
            <input type="email" id="name" name="email">
            <span class="error"><?php echo $mailerr ?> </span>
            <label>Enter your password</label>
            <input type="password" id="password" name="pass">
            <span class="error"><?php echo $passerr ?> </span>
            <button type="submit" id="log">Signup</button>
            </form>
            <label id="change">Already have an account ..<a href="signup.php" style="font-size: medium;">Login Up</a></label>
        </div>
        <script>
            window.open="index.php";
        </script>
    </body>
</html>
