<?php
ob_start();
session_start();
require_once 'action/dbconnect.php';
if( !isset($_SESSION['user'])  && !isset($_SESSION['admin']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}
if(isset($_SESSION['superadmin'])){
    header("Location: superadmin.php");
    exit;
}
$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id= ".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

$resItem=mysqli_query($conn, "SELECT * FROM pets");


?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Needy Paws - Seniors</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
    <script type="text/javascript">
  $(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        var input = $(this).val();
        var dropdownresult = $(this).siblings(".result");
        if(input.length){
            $.get("search.php", {term: input}).done(function(data){
                dropdownresult.html(data);
            });
        } else{
            dropdownresult.empty();
        }
    });

    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

   <style type="text/css">
       .manageUser {
           width : 50%;
           margin: auto;
       }

   </style>

</head>
<body>
<div class ="text-center mt-0 pt-0">
  <div class="bg-dark pb-3">
      
    <h1 class="h1 text-center text-light">Needy Paws - Homepage</h1>
    <div class="container d-flex justify-content-around my-2">
        <a href="home.php"><button type="button" class="btn btn-primary ml-5">Show all pets</button></a>
        <a href="general.php"><button type="button" class="btn btn-success ml-5">Show small & large</button></a>
        <a href="senior.php"><button type="button" class="btn btn-warning ml-5">Seniors</button></a>
        <a href="logout.php?logout"><button type="button" class="btn btn-danger ml-5">Logout</button></a>
    </div>
        

    <div class="search-box pt-3">
          <input type="text" class="text-center" autocomplete="off" placeholder="Search by name"/>
          <div class="result"></div>
      </div>
    </div>

    <div class="container-fluid mt-5 d-flex flex-wrap justify-content-around row">

            <?php
           $sql = "SELECT * FROM pets WHERE senior = 'yes'";
           $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   echo  "
                   <div class='card my-2 col-sm-5 px-0'>
                     <img class='card-img-top' src='".$row['image']."' alt='Card image cap'>
                     <div class='card-body'>
                       <h5 class='card-title'>".$row['name']."</h5>
                       <h6>Age: ".$row['age']."</h6>
                       <p class='card-text'>".$row['description']."</p>
                     </div>
                    </div>
                   " ;
               }
           } else  {
               echo  "<div><div colspan='5'><center>No Data Avaliable</center></div></div>";
           }
            ?>
    </div>
</body>
</html>