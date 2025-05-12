<?php
include '../conexion.php';
// Agregar imagen a la bd
$foto = $_FILES['imagen'];  // Cambié 'foto' a 'imagen'
$tmp_name = $foto['tmp_name'];
$img_file = $foto['name'];

$carpeta = '../diseño/img/usuario';
$ruta = $carpeta . '/' . $img_file;
if (!move_uploaded_file($tmp_name, $ruta)) {
    $mensaje = "La imagen no ha sido enviada. $correo ya existe";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}

$sql= mysqli_query($con, "INSERT INTO tabla_pruebas VALUES('hola','$ruta')");
