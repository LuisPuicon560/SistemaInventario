<?php
session_start(); 

include '../conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$usuario = $_POST['user'];
$contrasena = $_POST['contrasena'];

// Verificar si el usuario ya existe en la base de datos
$verificar = mysqli_query($con, "SELECT id_usuario FROM usuario WHERE id_usuario = '$usuario'");

if (mysqli_num_rows($verificar) > 0) {
    $mensaje = "El usuario '$usuario' ya existe. Por favor, elija otro nombre de usuario.";
    $_SESSION['mensaje'] = $mensaje;
    header("location: ../entrada/usuario.php");
    exit();
}

$contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
// Insertar los datos en la base de datos
$sql = mysqli_query($con, "INSERT INTO usuario (nombre_usuario, correo_usuario, usuario_usuario, contrasena_usuario) VALUES ('$nombre', '$correo', '$usuario', '$contrasenaEncriptada')");

if ($sql) {
    $mensaje = "Registro exitoso. ¡Bienvenido!";
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../entrada/usuario.php');
    exit();
} else {
    $mensaje = "Ha ocurrido un error al registrar el usuario. Por favor, inténtelo de nuevo.";
    $_SESSION['mensaje'] = $mensaje;
    header('location: ../entrada/usuario.php');
}

mysqli_close($con);
?>
