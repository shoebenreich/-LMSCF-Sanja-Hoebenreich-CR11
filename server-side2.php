<?php
    $conn = new mysqli("localhost" , "root", "", "cr11_sanja_hoebenreich_petadoption");
    if(isset($_GET['delete_id'])) {

        	$delete_id = mysqli_real_escape_string($conn,$_GET['delete_id']);
        if ($conn->query("DELETE FROM pets WHERE pet_id = '$delete_id'" )){
        	//redirect to admin page
        	header("Location: admin.php");
            echo "<span>deleted successfully...!!</span>";
        
    
        } else {
            echo "ERROR";
        }
}
?>