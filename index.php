<?php
//session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "practicephpdb";

$conn = new mysqli($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$usernameErr = $passwordErr = $username = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["username"])){
        $usernameErr = "Please enter a username";
    } else {
        $username = filter($_POST["username"]);
    }

    if(empty($_POST["password"])){
        $passwordErr = "Please enter a password";
    } else {
        $password = filter($_POST["password"]);
    }



    //SQL Selection
    $sql="SELECT * FROM `user` WHERE username='" . $username . "' AND password='" . $password. "';";
    $result = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($result);
    if($count == 1){
        header("Location: http://localhost:63344/loginPage/login.php");
    }
}

function filter($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="./js/script.js"></script>
</head>

<body>
<div>
    <h3>Login</h3>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Please enter your email or username</label><br>
        <input id="username" type="text" name="username" value="<?php echo $username ?>"><span
                class="error"><?php echo $usernameErr; ?></span><br><br>
        <label for="password">Please enter your password</label><br>
        <input id="password" type="password" name="password"><span class="error"><?php echo $passwordErr; ?></span><br>
        <input type="checkbox" name="showPassword" id="showPass">
        <label id="showPassLabel" for="showPass">Show password</label><br><br>
        <input type="submit" value="Log In">
        <a href="/register.php">Sign Up</a>
    </form>
</div>


</body>
</html>