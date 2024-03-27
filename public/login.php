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
        <label for="inputUsername">Username</label>
        <input name="Username" type="username" id="Username" class="form-control" placeholder="Username" required
               autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="Password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
        <!--        https://www.w3schools.com/howto/howto_js_redirect_webpage.asp -->
        <button name="Reg" value="Reg" class="button" type="button" onclick="redirectToRegister()">Register</button>

        <button name="Guest" value="Guest" class="button" type="button" onclick="redirectAsGuest()">Continue as Guest
        </button>
    </form>


    <script>
        function redirectToRegister() {
            window.location.href = 'register.php'; // Redirect to newMember.php
        }

        function redirectAsGuest() {
            <?php
            $_SESSION['Username'] = "Guest";
            $_SESSION['Active'] = true;
            //            header("location:index.php");

            ?>
            window.location.href = 'index.php';
        }
    </script>
</div>

<?php
/* Check if login form has been submitted */
/* isset — Determine if a variable is declared and is different than
NULL*/
/* Check if the form's username and password matches */
/* these currently check against variable values stored in
config.php but later we will see how these can be checked against
information in a database*/

if (isset($_POST['Submit'])) {
    try {
        require_once('../config.php');
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT username, password from users where username = :USER";
        $statement = $connection->prepare($sql);
        $tmpUser = $_POST['Username'];
        $statement->bindParam(':USER', $tmpUser, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row => $rows) {
            $fname_db = $rows['username'];
            $pwd_db = $rows['password'];
            if (($_POST['Username'] == $fname_db) && ($_POST['Password'] == $pwd_db)) {
                $_SESSION['Username'] = $fname_db;
                $_SESSION['Active'] = true;

                header("location:index.php");
                exit;
            } else {
                echo 'Incorrect Username or Password';
            }
        }
    } catch
    (Exception $e) {
        echo '<div class="messages-error">Error Logging in:' . $e->getMessage() . '</div>';
    }
}

//        if ($result && $statement->rowCount() > 0 && $result2 && $statement2->rowCount() > 0) {
//            $_SESSION['Username'] = $username;
//            $_SESSION['Active'] = true;
//            header("location:index.php");
//        }
//        else {
//            header("location:newMember.php");
//        }

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
//    else
//        echo 'Incorrect Username or Password';
//
//        if (isset($_POST['Reg'])) {
//            header("location:newMember.php");
//            exit;
//        }
?>

</body>
</html>