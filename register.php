<?php
//require_once "config.php";

$server = "localhost";
$username = "root";
$password = "";
$database = "practicephpdb";

$conn = new mysqli($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $password = $usernameErr = $passwordErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["username"])){
        $usernameErr = "Username is required";
    } else {
        $username = filter($_POST["username"]);
    }

    if(empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = filter($_POST["password"]);
    }

    $sql="SELECT * FROM `user` WHERE username='" . $username . "';";
    $result = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($result);

    if($count === 0){
        $sql = "INSERT INTO user (username, password)
VALUES ('" . $username . "', '" . $password . "')";
        $conn->query($sql);
        header("Location: http://localhost:63344/loginPage/index.php");
    } else {
        $usernameErr = "Username is already taken, please choose a different one";
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
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="./js/script.js"></script>
</head>
<body>

<div>
    <h3>Register</h3>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Type in your username here</label><br>
        <input id="username" name="username" type="text" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span>
        <br>
        <label for="password">Type in your password here</label><br>
        <input id="password" name="password" type="password">
        <span class="error"><?php echo $passwordErr; ?></span><br>
        <input type="checkbox" name="showPassword" id="showPass">
        <label id="showPassLabel" for="showPass">Show password</label><br>
        <label for="passwordConfirm">Please re-enter your password</label>
        <br>
        <input type="submit" value="Sign up">
    </form>
</div>



</body>
</html>
