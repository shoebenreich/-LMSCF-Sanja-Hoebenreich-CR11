<?php 
ob_start();
session_start();
require_once 'dbconnect.php';
if( !isset($_SESSION['user'])  && !isset($_SESSION['admin']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['user'])){
    header("Location: home.php");
    exit;
}
if(isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}


if ($_POST) {
    $id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $permissions = $_POST['permissions'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body class="text-center">
    <?php
    if($password == ""){
        $sql = "UPDATE users SET `user_id` = $id, `first_name` = '$first_name', `last_name` =' $last_name', `user_name` = '$user_name', `email` = '$email', `permissions` = '$permissions' WHERE `user_id` = $id";
        if($conn->query($sql) === TRUE) {
            echo  "<h2 class='alert alert-success mt-5'>Successfully Updated</h2>";
            echo "<a href='../superadmin.php'><button type='button' class='btn btn-success'>Back</button></a>";
        } else {
                echo "<h2 class='alert alert-danger'>Error while updating record : ". $conn->error ."</h2>";
        }
    
        $conn->close();
    
    } else {

        $pwd= hash("sha256",$password);

        $sql = "UPDATE users SET `user_id` = $id, `first_name` = '$first_name', `last_name` =' $last_name', `user_name` = '$user_name', `email` = '$email', `pwd` = '$pwd', `permissions` = '$permissions' WHERE `user_id` = $id";

        if($conn->query($sql) === TRUE) {
            echo  "<h2 class='alert alert-success mt-5'>Successfully Updated</h2>";
            echo "<a href='../superadmin.php'><button type='button' class='btn btn-success'>Back</button></a>";
        } else {
                echo "<h2 class='alert alert-danger'>Error while updating record : ". $conn->error ."</h2>";
        }

        $conn->close();
    }
    ?>
</body>
</html>