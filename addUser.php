<?php
ob_start();
session_start();
require_once 'action/dbconnect.php';

if( !isset($_SESSION['user'])  && !isset($_SESSION['admin']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['user'])){
    header("Location: home.php");
    exit;
}

if(count($_POST)>0){
    $conn = new mysqli("localhost" , "root", "", "cr11_sanja_hoebenreich_petadoption");

    $first_name = trim($_POST['first_name']);
    $first_name = strip_tags($first_name);
    $first_name = htmlspecialchars($first_name);

    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);

    $user_name = trim($_POST['user_name']);
    $user_name = strip_tags($user_name);
    $user_name = htmlspecialchars($user_name);

    $email = $_POST['email'];
    $password = $_POST['password'];
    $permissions = $_POST['permissions'];

    $pwd = hash('sha256',$password);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Needy Paws - Superadmin Add User</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="superadmin.php"><strong>User Administration </strong><span class="sr-only">(current)</span></a>
        </div>
    </nav>
    <h4 class="text-center text-bold my-5">Add User</h4>
    <div class="container bg-dark rounded">
        <form action="addUser.php" method="post">
            <div class="w-75 mx-auto">
                <div class="w-75 mx-auto d-flex justify-content-between my-2">
                    <input type="text" name="first_name" placeholder="first name" class="text-center rounded my-2">
                    <input type="text" name="last_name" placeholder="last name" class="text-center rounded my-2">
                </div>
                <div class="w-75 mx-auto d-flex justify-content-between my-2">
                    <input type="text" name="user_name" placeholder="user name" class="text-center rounded my-2">
                    <input type="text" name="email" placeholder="email" class="text-center rounded my-2">
                    <input type="password" name="password" placeholder="password" class="text-center rounded my-2">
                </div>
                <div class="w-75 mx-auto d-flex justify-content-center my-2">
                    <select name="permissions" class="rounded my-2">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                    
                </div>
                <div class="w-75 mx-auto d-flex justify-content-center my-2">
                    <input type="submit" value="Add User" class="btn btn-success text-center rounded my-2">
                </div>
            </div>
        
        </form>
    
    </div>
    <?php
    if ($_POST) {
        if($conn->query("INSERT INTO users (first_name, last_name, user_name, email, pwd, permissions) VALUES ('$first_name', '$last_name', '$user_name', '$email', '$pwd', '$permissions')")) {
            echo "<div class='alert alert-success text-center'>New User created</div>";
        } else {
            echo "<div class='alert alert-success text-center'>User creation failed</div>";
        }  
    }     
    
    ?>
</body>
</html>