<?php
if (isset($_POST['submit'])) {
    require "../common.php";
    try {
        require_once '../src/DBconnect.php';
        $new_user = array(
            "name" => escape($_POST['name']),
            "password" => escape($_POST['password'])
        );
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


if (isset($_POST['submit']) && $statement){
    echo $new_user['name']. ' successfully added';
    header("location:index.php");
}
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


    <h2>Add a user</h2>
    <div id="dataForm">
        <form method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>

            <label for="password">password</label>
            <input type="text" name="password" id="password" required>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="index.php">Back to home</a>

<?php include "../template/footer.php"; ?>