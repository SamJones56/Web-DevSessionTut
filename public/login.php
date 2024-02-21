<?php require_once('../config.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <title>Sign in</title>
</head>


<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" >Username</label>
        <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
        <button name="Reg" value="Reg" class="button" type="button" onclick="redirectToRegister()">Register</button>
    </form>

    </form>


    <script>
        function redirectToRegister() {
            window.location.href = 'register.php'; // Redirect to register.php
        }
    </script>
</div>

<?php
/* Check if login form has been submitted */
/* isset — Determine if a variable is declared and is different than
NULL*/
if(isset($_POST['Submit']))
{
    require "../common.php";
    /* Check if the form's username and password matches */
    /* these currently check against variable values stored in
   config.php but later we will see how these can be checked against
   information in a database*/
    $formUserName = $_POST['Username'];
    $formUserName = $_POST['Password'];

    $sql = "SELECT * FROM users WHERE username = username"
//    if( (escape($_POST['Username']) == $Username) && (escape($_POST['Password']) ==
//            $Password) )
//    {
//
//        /* Success: Set session variables and redirect to protected page*/
//        $_SESSION['Username'] = $Username; //store Username to the session
//        $_SESSION['Active'] = true;
//        header("location:index.php"); /* 'header() is used to redirect
//the browser */
//        exit; /*we’ve just used header() to redirect to another page but
//        we must terminate all current code so that it doesn’t run when we
//        redirect
//*/
//    }
    else
        echo 'Incorrect Username or Password';
}
else if(isset($_POST['Reg'])){
    header("location:register.php");
    exit;
}
?>
</body>
</html>
