<?php
include '../conexion.php';
// session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['roles'];

    $existe_correo = mysqli_query($con, "SELECT * FROM usuario WHERE correo_usuario='$correo'");
    if (mysqli_num_rows($existe_correo) > 0) {
        // $error = mysqli_error($con);
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    // Buscar el usuario en la base de datos
    $verificar = mysqli_query($con, "SELECT * FROM usuario WHERE user_usuario='$usuario' or dni_usuario='$dni'");
    $existe = mysqli_num_rows($verificar);
    $mensaje = '';
    if ($existe > 0) {
        while ($row = mysqli_fetch_assoc($verificar)) {
            if ($row['dni_usuario'] === $dni) {
                $error = mysqli_error($con);
                $mensaje = "El DNI $dni ya existe";
                echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                exit();
            } elseif (strcasecmp($row['user_usuario'], $usuario) == 0) {
                $error = mysqli_error($con);
                $mensaje = "El usuario $usuario ya existe";
                echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                exit();
            }
        }
    }

    if (!empty($mensaje)) {
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    } else {
        $insert_persona = mysqli_query($con, "INSERT INTO persona(nombres,priapellido_persona,segapellido_persona,celular_persona) VALUES('$nombres','$apellido_paterno','$apellido_materno','$celular')");

        if ($insert_persona) {
            $id_persona = mysqli_insert_id($con);
            $pass_fuerte = password_hash($contrasena, PASSWORD_DEFAULT);
            $insert_usuario = mysqli_query($con, "INSERT INTO usuario(id_persona,dni_usuario,correo_usuario,user_usuario,contrasena_usuario,id_rol) VALUES('$id_persona','$dni','$correo','$usuario','$pass_fuerte','$rol')");
            if ($insert_usuario) {
                $mensaje = "Usuario registrado de manera correcta";
                echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
                exit();
            } else {
                $mensaje = "No se pudo registrar usuario";
                echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                exit();
            }
        } else {
            $mensaje = "No se pudo registrar persona";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "No se pudo obtener la informacion del ajax";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}

mysqli_close($con);
