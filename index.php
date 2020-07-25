<?php
  ob_start();
  session_start();
  require_once 'action/dbconnect.php';

  // If Session "User" is set you are redirected to home.php
  if ( isset($_SESSION['user' ])!="" ) {
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

  $error = false;

  // on Sign-In Button:
  if( isset($_POST['bttn-login']) ) {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if(empty($email)){
      $error = true;
      $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid email address.";
    }

    if (empty($pass)){
      $error = true;
      $passError = "Please enter your password." ;
    }

    if (!$error) {

      $password = hash( 'sha256', $pass); // password hashing

      $res=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'" );
      $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
      $count = mysqli_num_rows($res);

      if( $count == 1 && $row['pwd']==$password ) {
      
      if($row['permissions']==superadmin) {
        $_SESSION['superadmin'] = $row['user_id'];
        header("Location: superadmin.php");

      }else if($row["permissions"]==admin) {
        $_SESSION['admin'] = $row['user_id'];
        header("Location: admin.php");
      }else{
        $_SESSION['user'] = $row['user_id'];
        header( "Location: home.php");
      }
      }else {
        $errMSG = "<span class='alert alert-danger'>Incorrect login Data, try again." ;
      }
    }

  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>

<link rel="stylesheet" href ="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body class="text-center">

<div class="container">
  <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">


    <h2 class="mt-5">Welcome Back!</h2>
    
    <hr/>

    <?php
    if ( isset($errMSG)) {
    echo  $errMSG; ?>
      <?php
    }
    ?>

    <input type="email" name="email" class="form-control text-center w-75 mx-auto my-2" placeholder= "Your Email" value="<?php echo $email; ?>" maxlength="50"/>

    <span class="text-danger"><?php  echo $emailError; ?></span>

    <input type="password" name="pass"  class="form-control text-center w-75 mx-auto my-2" placeholder ="Your Password" maxlength="15"/>

    <span class="text-danger"><?php  echo $passError; ?></span>

    <hr/>

    <button class="btn btn-primary" type="submit" name="bttn-login">Sign In</button>


    <hr/>

    <span>Don't have an account? Register <a  href="register.php">here</a>!</span>


  </form> 
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
<script src="script-ajax.js"  type="text/javascript"></script>
</body>
</html>
<?php ob_end_flush(); ?>