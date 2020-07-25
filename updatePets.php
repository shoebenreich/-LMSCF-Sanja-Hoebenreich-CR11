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
if(isset($_SESSION['superadmin'])){
    header("Location: superadmin.php");
    exit;
}
if ($_GET['id']) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM pets WHERE pet_id = '$id'" ;
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
<div class="container-fluid mt-5 mx-auto text-center">
<form action="action/a_updatePets.php" method="post">
       <table class="table table-dark w-100">
           <thead>
           <tr>
           <th>PetID</th>
           <th>Name</th>
           <th>Age</th>
           <th>Location</th>
           <th>Description</th>
           <th>Image</th>
           <th>Type</th>
           <th>Hobbies</th>
           <th>Senior</th>
           </tr>
           </thead>
           <tbody>
           <tr>
            <td><?php echo $data['pet_id']?><input type="hidden" name="pet_id" value="<?php echo $data['pet_id']?>"></td>
            <td><input name="name" type="text" placeholder="<?php echo $data['name']?>" value="<?php echo $data['name']?>"></td>
            <td><input name="age" type="number" placeholder="<?php echo $data['age']?>" value="<?php echo $data['age']?>"></td>
            <td><select name="location">
            <option value="1">100 Mile House</option>
            <option value="2">Balvano</option>
            <option value="3">Spiere</option>
            <option value="4">Bevel</option>
            </select></td>
            <td><textarea name="description"cols="30" rows="5" placeholder="<?php echo $data['description'] ?>"><?php echo $data['description'] ?></textarea></td>
            <td><input name="image" type="text" placeholder="<?php echo $data['image']?>" value="<?php echo $data['image']?>"></td>
            <td><select name="type">
            <option value="small">small</option>
            <option value="large">large</option>
            </select></td>
            <td><input name="hobbies" type="text" placeholder="<?php echo $data['hobbies']?>" value="<?php echo $data['hobbies']?>"></td>
            <td><select name="senior">
            <option value="yes">yes</option>
            <option value="no">no</option>
            </select></td>
           </tr>
           </tbody>
       </table>
       <div class="text-center">
               <button type="submit" class="btn btn-success">Save</button>
               <a href= "admin.php"><button type="button" class="btn btn-light bg-dark text-white">Back</button ></a>
        </div>
   </form >
   </div>
</body>
</html>