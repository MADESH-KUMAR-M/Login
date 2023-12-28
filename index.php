<?php

$host = "localhost";
$user = "root";
$password  = "";
$db = "test";

$err = $passerr = "";
$name = $pass = "";

$conn = mysqli_connect($host, $user , $password , $db);

$sql = ("SELECT * FROM login");
$flag = true;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["uname"])){
        $err = "This field is required";
        $flag = false;
    }else{
        $name = $_POST["uname"];
    }
    if(empty($_POST["pass"])){
        $passerr = "This field is required ";
        $flag = false;
    }else{
        $pass = $_POST["pass"];
    }

    if($flag){
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row["user"] === $name){
                    if($row["password"] == $pass){
                        echo "<script>alert('login successful');</script>";
                        $flag = true;
                        break;
                    }else{
                        $flag = false;
                    }
                }else{
                    $flag = false;
                }
            }
        }
    }

    if($flag === false){
        echo "<script>alert('Invalid username/password');</script>";
    }
}


?>
<html>
    <head>
        <title>
            LOGIN PAGE
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
            <h1>LOGIN</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <label>Enter your username</label>
            <input type="text" id="name" name="uname" value="<?php echo $name ?>">
           <span class="error"><?php echo $err ?></span>
            <label>Enter your password</label>
            <input type="password" id="password" name="pass" value="<?php echo $pass ?>">
           <span class="error"><?php echo $passerr ?></span>
            <button id="log" type="submit">submit </button>
            </form>
            <label id="change">Don't have Account  ><a href="signup.php" style="font-size: medium;">Sign up</a></label>
        </div>
    </body>
</html>
