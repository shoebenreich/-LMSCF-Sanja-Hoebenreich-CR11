<?php
ob_start();
session_start();
require_once 'action/dbconnect.php';

if(!isset($_SESSION['user']) && !isset($_SESSION['admin']) && !isset($_SESSION['superadmin'])) {
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

    $sql = "SELECT * FROM users WHERE user_id = '$id'";
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
    <title>Needy Paws - Superadmin Panel</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="superadmin.php"><strong>User Administration </strong><span class="sr-only">(current)</span></a>
        </div>
    </nav>

    <h3 class="alert alert-warning text-center mt-5">Are you sure you want to delete this?</h3>
    <form align='center' action ="action/a_delete.php" method="post">
    <input type="hidden" name= "id" value="<?php echo $data['user_id']?>"/>
    <div class="container d-flex justify-content-around">
    <button type="submit" class="btn btn-success">YES, do it!</button>
    <a href = "superadmin.php"><button type="button" class="btn btn-danger">No, go back!</button></a>
    </div>
    </form>

</body>
</html>