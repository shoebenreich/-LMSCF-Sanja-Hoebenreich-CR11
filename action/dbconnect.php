<?php
// Stopping the NOTICE error messages
error_reporting( ~E_DEPRECATED & ~E_NOTICE );


define ('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define ('DBNAME', 'cr11_sanja_hoebenreich_petadoption');

$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);


if  ( !$conn ) {
 die("Connection failed : " . mysqli_error());
}


?>