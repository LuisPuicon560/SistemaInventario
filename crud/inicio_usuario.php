<?php
include '../conexion.php';
session_start();
if(isset($_POST['login'])){
    $usuario = mysqli_real_escape_string($con,$_POST['usuario']);
    $contrasena = mysqli_real_escape_string($con,$_POST['contrasena']);
    
    // Buscar el usuario en la base de datos
    $verficar = mysqli_query($con, "SELECT p.*,u.*,r.* FROM persona p INNER JOIN usuario u ON p.id_persona= u.id_persona  INNER JOIN roles r ON r.id_rol= u.id_rol  WHERE user_usuario='$usuario' and estado=1 ");
    $nr =mysqli_num_rows($verficar);
    $buscarpass= mysqli_fetch_array($verficar);

    if (($nr==1)&&(password_verify($contrasena,$buscarpass['contrasena_usuario']))) {
        $_SESSION['id_user'] = $buscarpass['id_usuario'];
        $_SESSION['rol'] = $buscarpass['id_rol'];
        $_SESSION['mensaje'] = "<div class='bf-warning text-center alert alert-primary'>Bienvenido " .$buscarpass['nombres']." ".$buscarpass['priapellido_persona']." ".$buscarpass['segapellido_persona']. "</div>";
        header('location: ../entrada/index.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "<div class='text-center alert alert-danger' role='alert'>Usuario o contraseña incorrecta</div>";
        header('location: ../index.php');
        exit(); 
    }
}
?>


