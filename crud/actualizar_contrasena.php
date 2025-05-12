<?php
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contrasena = $_POST['pass'];
    $correo = $_POST['correo'];
    $pass_fuerte = password_hash($contrasena, PASSWORD_DEFAULT);

    $actualizar = mysqli_query($con, "UPDATE usuario SET contrasena_usuario= '$pass_fuerte' WHERE correo_usuario= '$correo'");
    if ($actualizar) {
        echo json_encode(['success' => true]);
    } else {
        // Devuelve una respuesta JSON indicando el error
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
}
