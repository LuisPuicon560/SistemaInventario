<?php
// session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPersona = $_POST['idPersona'];
    $idRol = $_POST['idRol'];
    $idUsuario = $_POST['idUsuario'];
    $dni = $_POST['dni'];
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];

    // Verificar si los datos han cambiado
    $verificar_cambios = mysqli_query($con, "SELECT p.*,u.*,r.* FROM persona p INNER JOIN usuario u ON p.id_persona = u.id_persona INNER JOIN roles r ON r.id_rol=u.id_rol WHERE p.id_persona='$idPersona' AND p.nombres='$nombres' AND p.priapellido_persona='$apellido_paterno' AND p.segapellido_persona='$apellido_materno' AND p.celular_persona='$celular' AND u.correo_usuario='$correo' AND u.dni_usuario='$dni' AND u.user_usuario='$usuario' AND r.id_rol='$idRol'");

    if (mysqli_num_rows($verificar_cambios) > 0) {
        $mensaje = "No se realizaron cambios";
        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
        exit();
    }

    // verifica si existe correo
    $existe_correo = mysqli_query($con, "SELECT * FROM usuario WHERE correo_usuario='$correo' and id_usuario !=$idUsuario");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    // Verificar si el DNI ya existe para otro usuario
    $verificar_dni = mysqli_query($con, "SELECT * FROM usuario WHERE dni_usuario='$dni' and id_usuario != $idUsuario");

    if (mysqli_num_rows($verificar_dni) > 0) {
        $mensaje = "El DNI '$dni' ya está registrado para otro usuario.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar_usuario = mysqli_query($con, "SELECT * FROM usuario WHERE user_usuario='$usuario' and id_usuario != $idUsuario");

    if (mysqli_num_rows($verificar_usuario) > 0) {
        $mensaje = "El nombre de usuario '$usuario' ya está registrado para otro usuario.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    // Realizar las actualizaciones
    $update_persona = "UPDATE persona SET nombres='$nombres', priapellido_persona='$apellido_paterno', segapellido_persona='$apellido_materno', celular_persona='$celular' WHERE id_persona='$idPersona'";
    $result_persona = mysqli_query($con, $update_persona);

    if ($result_persona) {
        $update_usuario = "UPDATE usuario SET id_persona='$idPersona', dni_usuario='$dni', correo_usuario='$correo', user_usuario='$usuario', id_rol='$idRol' WHERE id_usuario='$idUsuario'";
        $resultado_usuario = mysqli_query($con, $update_usuario);

        if ($resultado_usuario) {
            $mensaje = "Datos del usuario editados correctamente.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar usuario.";
        }
    } else {
        $mensaje = "Error al editar persona.";
    }

    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
} else {
    $mensaje = "Error al obtener datos del ajax";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
