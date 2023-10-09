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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/css/styles.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-10 col-lg-6 register mx-auto p-5">
                <h3 class="page-title">Register</h3>
                <form class="d-flex flex-column" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <!--First name-->
                    <label class="mt-2" for="fName">First name:</label>
                    <input type="text" id="fName" name="fName">
                    <!--Last name-->
                    <label class="mt-2"  for="lName">Last name:</label>
                    <input type="text" id="lName" name="lName">
                    <!--Email-->
                    <label class="mt-2"  for="email">E-Mail:</label>
                    <input type="text" id="email" name="email">


                    <!--Username-->
                    <label class="mt-2"  for="username">Type in your username here</label>
                    <input id="username" name="username" type="text" value="<?php echo $username; ?>">
                    <span class="error"><?php echo $usernameErr; ?></span>

                    <!--Password-->
                    <label class="mt-2"  for="password">Type in your password here</label>
                    <input id="password" name="password" type="password">
                    <span class="error"><?php echo $passwordErr; ?></span>
                    <div class="showPassword">
                        <input type="checkbox" name="showPassword" id="showPass">
                        <label id="showPassLabel" for="showPass">Show password</label>
                    </div>


                    <!--Password confirm-->
                    <label class="mt-2"  for="passwordConfirm">Please re-enter your password</label>
                    <input id="passwordConfirm" name="passwordConfirm">
                    <div class="showPassword">
                        <input type="checkbox" name="showPassword" id="showPassConfirm">
                        <label id="showPassConfirmLabel" for="showPassConfirm">Show password</label>
                    </div>

                    <button type="submit" class="mt-2 submit btn btn-primary">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script defer src="./js/script.js"></script>
</body>
</html>
