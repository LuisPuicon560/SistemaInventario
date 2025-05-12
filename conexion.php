<?php 
// datos de conexion
$localhost= "localhost";
$user="root";
$pass="";
$db="bd_mega";
// entrada a la bd con mysqli_connet
$con = mysqli_connect($localhost, $user, $pass, $db);
// carateres a usar
$con->set_charset("utf8");

if (!mysqli_connect_errno()) {
} else {
    echo 'Error de conexion ..codigo: '.mysqli_connect_errno().'<br/>';
}
// mysqli_close($con);
?>
