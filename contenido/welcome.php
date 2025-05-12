<?php
session_start();
if (!isset($_SESSION['id_user']) || !isset($_SESSION['rol'])) {
    header("location: ../index.php");
    // permisos
    exit();
}

$id_usuario= $_SESSION['id_user'];
$sql="SELECT p.nombres,p.priapellido_persona,r.usuario_rol FROM persona p INNER JOIN usuario u ON p.id_persona=u.id_persona INNER JOIN roles r ON r.id_rol=u.id_rol WHERE id_usuario='$id_usuario'";
$resultado = $con->query($sql);
$row =$resultado->fetch_assoc();