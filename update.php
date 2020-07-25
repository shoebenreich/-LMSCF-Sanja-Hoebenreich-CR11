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
if(isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}
if ($_GET['id']) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM users WHERE user_id = '$id'" ;
    $result = $conn->query($sql);
 
    $data = $result->fetch_assoc();
 
    $conn->close();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Superadmin - Update user</title>
</head>
<body>
<div class="container mt-5">
<form action="action/a_update.php" method="post">
       <table class="table table-dark">
           <thead>
           <tr>
           <th>UserID</th>
           <th>First Name</th>
           <th>Last Name</th>
           <th>User Name</th>
           <th>Email</th>
           <th>Password</th>
           <th>Permissions</th>
           </tr>
           </thead>
           <tbody>
           <tr>
            <td><?php echo $data['user_id']?><input type="hidden" name="user_id" value="<?php echo $data['user_id']?>"></td>
            <td><input name="first_name" type="text" placeholder="<?php echo $data['first_name']?>" value="<?php echo $data['first_name']?>"></td>
            <td><input name="last_name" type="text" placeholder="<?php echo $data['last_name']?>" value="<?php echo $data['last_name']?>"></td>
            <td><input name="user_name" type="text" placeholder="<?php echo $data['user_name']?>" value="<?php echo $data['user_name']?>"></td>
            <td><input name="email" type="email" placeholder="<?php echo $data['email']?>" value="<?php echo $data['email']?>"></td>
            <td><input name="password" type="password" placeholder="change password here"></td>
            <td><select name="permissions">
            <option value="admin">Admin</option>
            <option value="user" selected>User</option>
            <option value="superadmin">Superuser</option>
            </select></td>
           </tr>
           </tbody>
       </table>
       <div class="text-center">
               <button type="submit" class="btn btn-success">Save</button>
               <a href= "superadmin.php"><button type="button" class="btn btn-light bg-dark text-white">Back</button ></a>
        </div>
   </form >
   </div>
</body>
</html>