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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Needy Paws - Superadmin Panel</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="superadmin.php"><strong>User Administration </strong><span class="sr-only">(current)</span></a>
        </div>
    </nav>
    <a href="logout.php?logout" class="float-right"><button type="button" class="btn btn-danger ml-5">Logout</button></a>
    <div class="container my-5">
    <table class="table table-dark my-5">
    <thead>
    <tr>
    <th scope="col">UserID</th>
    <th scope="col">First Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">User Name</th>
    <th scope="col">Email</th>
    <th scope="col">Permissions</th>
    <th scope="col">Delete/Change</th>
    </tr>
    </thead>
    <tbody>
    <?php
           $sql = "SELECT * FROM users";
           $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo  "<tr>
                        <td><strong>".$row['user_id']."</td>
                        <td>".$row['first_name']."</td>
                        <td>".$row['last_name']."</td>
                        <td>".$row['user_name']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['permissions']."</td>
                        <td><a href='delete.php?id=".$row['user_id']."'><button class='btn btn-danger'>Delete</button></a>
                            <a href='update.php?id=".$row['user_id']."'><button class='btn btn-warning'>Edit</button></a></td>
                    </tr>" ;
               }
           } else  {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
           }
            ?>
    </tbody>
    </table>
    <a href="addUser.php"><button class='btn btn-success w-100'>Add New User</button></a>
    </div>
</body>
</html>