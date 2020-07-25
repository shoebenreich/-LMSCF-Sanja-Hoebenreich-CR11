<?php
ob_start();
session_start();
 // If Session "User" is set you are redirected to home.php
 if ( isset($_SESSION['user'])!="" ) {
   header("Location: home.php");
   exit;
 }

 //IF Session "Admin" is set you are redirected to admin.php
 if(isset($_SESSION['admin']) != ''){
   header("Location: admin.php");
   exit;
 }

 // If Session "Superadmin" is set you are redirected to superadmin.php
 if(isset($_SESSION['superadmin']) != ''){
   header("Location: superadmin.php");
   exit;
 }
include_once 'action/dbconnect.php';
$error = false;
if ( isset($_POST['btn-signup'])) {
 
   $first_name = trim($_POST['first_name']);
   $first_name = strip_tags($first_name);
   $first_name = htmlspecialchars($first_name);

   $last_name = trim($_POST['last_name']);
   $last_name = strip_tags($last_name);
   $last_name = htmlspecialchars($last_name);

   $user_name = trim($_POST['user_name']);
   $user_name = strip_tags($user_name);
   $user_name = htmlspecialchars($user_name);

   $email = trim($_POST['email']);
   $email = strip_tags($email);
   $email = htmlspecialchars($email);

   $pass = trim($_POST['pass']);
   $pass = strip_tags($pass);
   $pass = htmlspecialchars($pass);

   if (empty($first_name) || empty($last_name) || empty($user_name)) {
      $error = true ;
      $nameError = "Please fill in everything above.";
   } else if (strlen($first_name)< 3 || strlen($last_name)< 3 || strlen($user_name)< 3) {
      $error = true;
      $nameError = "Your First Name, Last Name and Username have to be minimum 3 characters long.";
   } else if (!preg_match("/^[a-zA-Z ]+$/",$first_name)) {
      $error = true ;
      $nameError = "Names must contain alphabets";
   }else if (!preg_match("/^[a-zA-Z ]+$/",$last_name)) {
      $error = true ;
      $nameError = "Names must contain alphabets";
   }else if (!preg_match('/^[a-zA-Z]*([a-zA-Z])*$/',$user_name)) {
      $error = true ;
      $nameError = "Names must contain alphabets";
   }

   if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $emailError = "Please enter valid email address." ;
   } else {
      $query = "SELECT email FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $query);
      $count = mysqli_num_rows($result);
      if($count!=0){
         $error = true;
         $emailError = "Provided email is already in use.";
      }
   }

   if (empty($pass)){
      $error = true;
      $passError = "Please enter password.";
   } else if(strlen($pass) < 6) {
      $error = true;
      $passError = "Password must have atleast 6 characters." ;
   }
   else if(preg_match('/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/', $pass)){
      $error = true;
      $passError = "Password must contain at least one special character" ;
   }

   $password = hash('sha256' , $pass);

   if( !$error ) {
      $query = "INSERT INTO users(first_name, last_name, `user_name`, email, pwd) VALUES ('$first_name','$last_name','$user_name','$email','$password')";
      $res = mysqli_query($conn, $query);
   
      if ($res) {
         $errTyp = "success";
         $errMSG = "Successfully registered, you may login now";
         unset($first_name);
         unset($last_name);
         unset($user_name);
         unset($email);
         unset($pass);
      } else  {
         $errTyp = "danger";
         $errMSG = "Something went wrong, try again later..." ;
      }
   
   }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Needy Paws - Register</title>
<link rel="stylesheet"  href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="text-center">
 <div class="container">
    <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
 
     
      <h2 class="mt-5">Register now!</h2>
      <hr/>
      <?php
         if ( isset($errMSG) ) {
      ?>
      <div  class="alert alert-<?php echo $errTyp ?>">
         <?php echo  $errMSG; ?>
      </div>
      <?php
      }
      ?>
      <input type ="text" name="first_name" class ="form-control text-center w-75 mx-auto my-2" placeholder ="Enter First Name" maxlength ="50" value = "<?php echo $first_name ?>"/>
      <input type ="text" name="last_name" class ="form-control text-center w-75 mx-auto my-2" placeholder ="Enter Last Name" maxlength ="50" value = "<?php echo $last_name ?>"/>
      <input type ="text" name="user_name" class ="form-control text-center w-75 mx-auto my-2" placeholder ="Enter User Name" maxlength ="50" value = "<?php echo $user_name ?>"/>

      <span class = "text-danger"> <?php echo $nameError; ?></span>

      <input type = "email" name = "email" class = "form-control text-center w-75 mx-auto my-2" placeholder = "Enter Your Email" maxlength = "40" value = "<?php echo $email ?>"/>
   
      <span class = "text-danger"> <?php echo $emailError; ?> </span>

      <input type = "password" name = "pass" class = "form-control text-center w-75 mx-auto my-2" placeholder = "Enter Password" maxlength = "15"/>
         
      <span class = "text-danger"> <?php echo $passError; ?> </span>

      <hr/>

      <button type = "submit" class = "btn btn-primary" name = "btn-signup" >Sign Up</button>
         
      <hr/>

      <a href = "index.php">Go back to login</a>

      </form >
   </div> 
</body >
</html >
<?php  ob_end_flush(); ?>