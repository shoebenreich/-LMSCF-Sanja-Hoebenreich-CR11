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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Superadmin - Delete</title>
</head>
<body>
    <div class="text-center container">
    <?php 
    if ($_POST['id']) {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE user_id = '$id'";
        if($conn->query($sql) === TRUE) {
           echo "<h3 class='alert alert-success'>Successfully deleted!!</h3>";
           echo "<a href='../superadmin.php'><button class='btn btn-primary'>Go Back</button></a>";
       } else {
           echo "Error updating record : " . $conn->error;
       }
       $conn->close();
    } else 
        echo "Hello!"
    
    ?>
    </div>
</body>
</html>
