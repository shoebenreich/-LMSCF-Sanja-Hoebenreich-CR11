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
if(isset($_SESSION['superadmin'])){
    header("Location: superadmin.php");
    exit;
}


if ($_POST) {
    $id = $_POST['pet_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $type = $_POST['type'];
    $hobbies = $_POST['hobbies'];
    $senior = $_POST['senior'];
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

        $sql = "UPDATE pets SET `pet_id` = $id, `name` = '$name', `age` = $age, `fk_location_id` = $location, `description` = '$description', `image` = '$image', `type`= '$type', `hobbies`= '$hobbies', `senior` = '$senior' WHERE `pet_id` = $id";
        if($conn->query($sql) === TRUE) {
            echo  "<h2 class='alert alert-success mt-5'>Successfully Updated</h2>";
            echo "<a href='../admin.php'><button type='button' class='btn btn-success'>Back</button></a>";
        } else {
                echo "<h2 class='alert alert-danger'>Error while updating record : ". $conn->error ."</h2>";
        }
    
        $conn->close();
    ?>
</body>
</html>