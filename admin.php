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
    header("Location:superadmin.php");
    exit;
}
if(count($_POST)>0){
    $conn = new mysqli("localhost" , "root", "", "cr11_sanja_hoebenreich_petadoption");
       $description =  $_POST['description'];
       $age = $_POST['age'];
       $type = $_POST['type'];
       $location_id = $_POST['location'];
       $name = $_POST['name'];
       $image = $_POST['image'];
       $hobbies = $_POST['hobbies'];
       $senior = $_POST['senior'];

        if($conn->query("INSERT INTO pets (name, age, fk_location_id, description, image, type, hobbies, senior) VALUES ('$name', $age, $location_id, '$description', '$image', '$type', '$hobbies', '$senior')")) {
                echo "Insertion successful";
        } else {
                echo "Insertion failed";
        }       
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Needy Paws - Admin Panel</title>

   <style type="text/css">

   </style>

</head>
<body> 
<div class="container-fluid text-right"> <a href="logout.php?logout"><button type="button" class="btn btn-danger ml-5">Logout</button></a></div>
<div class="container-fluid">
<h2 class="text-center alert alert-success">Add a new pet:</h2> 
    <table class="table table-dark">
		    <form id="myForm" action="admin.php" method="POST">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Location</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Type</th>
            <th scope="col">Hobbies</th>
            <th scope="col">Senior</th>
            <th scope="col">Add</th>
            </tr>
            <tr>
            <td><input type="text" name= "name" placeholder="name"></td>
            <td><input type="text" name= "age" placeholder="age"></td>
            <td>
            <select name="location">
            <option value="1">100 Mile House</option>
            <option value="2">Balvano</option>
            <option value="3">Spiere</option>
            <option value="4">Bevel</option>
            </select>
            </td>
            <td><textarea type="text" name="description" placeholder="description"></textarea></td>
            <td><input type="text" name= "image" placeholder="image path"></td>
            <td>
            <select name="type">
            <option value="small">small</option>
            <option value="large">large</option>
            </select>
            </td>
            <td><input type="text" name= "hobbies" placeholder="hobbies"></td>
            <td>
            <select name="senior">
            <option value="yes">yes</option>
            <option value="no">no</option>
            </select>
            </td>
            <td><button class="btn btn-success" id="btn" type="submit" class="registerbtn" style="width:100px">Add</button>
            </td>
            </tr>
            </form>
    </table> 
    </div>
<div class ="text-center mx-5">
  <div class="h1 text-center m-2 text-primary">List of all pets</div>
   <div class="container-fluid"><table  border="1" cellspacing= "0" cellpadding="0" class="bg-white">
       <thead>
           <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Age</th>
                <th>Size</th>        		              
                <th>Address</th>
                <th>Image</th>
                <th>Hobbies</th>
                <th>Delete</th>
           </tr>
       </thead>
       <tbody>

            <?php
           $sql = "SELECT *,locations.city, locations.zip_code, locations.address, locations.house_number FROM pets INNER JOIN locations ON pets.fk_location_id = locations.location_id";
           $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo  "<tr>
                        <td><strong>" .$row['name']."</strong></td>
                        <td>" .$row['description']."</td>
                        <td>" .$row['age']."</td>
                        <td>" .$row['type']."</td>
                        <td>".$row['address']." ".$row['house_number']."<br>".$row['zip_code'].", " .$row['city']." </td>
                        <td><img width=80% src =" .$row['image']."></td>
                        <td>" .$row['hobbies']."</td>
                        <td><a href='server-side2.php?delete_id=".$row['pet_id']."'><button class='btn btn-danger'>Delete</button></a>
                            <a href='updatePets.php?id=".$row['pet_id']."'><button class='btn btn-warning w-100'>Edit</button></a></td>
                    </tr>" ;
               }
           } else  {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
           }
            ?>

           
       </tbody>
   </table>
   </div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
	<!-- <script src="script-ajax.js"  type="text/javascript"></script>  -->

</body>
</html>
<?php ob_end_flush(); ?>