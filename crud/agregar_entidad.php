<?php
require '../conexion.php';
// session_start();
// $mensaje = '';
if (isset($_POST['proveedor_proveedor'])) {

    // persona
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];


    // entidad
    $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
    $subtipo = mysqli_real_escape_string($con, $_POST['subtipo']);
    $ruc = mysqli_real_escape_string($con, $_POST['ruc']);
    $social = mysqli_real_escape_string($con, $_POST['rsocial']);
    $comercial = mysqli_real_escape_string($con, $_POST['rcomercial']);
    $direccion = mysqli_real_escape_string($con, $_POST['direccion']);
    $referencia = mysqli_real_escape_string($con, $_POST['referencia']);
    $distrito = mysqli_real_escape_string($con, $_POST['distrito']);
    $provincia = mysqli_real_escape_string($con, $_POST['provincia']);
    $departamento = mysqli_real_escape_string($con, $_POST['departamento']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    $existe_correo = mysqli_query($con, "SELECT * FROM entidad WHERE correo_entidad='$correo'");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    // Verificar si el RUC ya existe en la base de datos
    $verificar_ruc = mysqli_query($con, "SELECT n_documentacion from entidad where n_documentacion='$ruc'");
    $verificar_comercial = mysqli_query($con, "SELECT razon_comercial from entidad where  razon_comercial='$comercial'");

    if (mysqli_num_rows($verificar_ruc) > 0) {
        $mensaje = "El ruc $ruc ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else if (mysqli_num_rows($verificar_comercial) > 0) {
        $mensaje = "El nombre comercial '$comercial' ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        // Insertar en la tabla persona
        $insert_persona = mysqli_query($con, "INSERT INTO persona(celular_persona,telefono_persona) VALUES('$celular','$telefono')");

        // Obtener el ID de la persona recién insertada
        $id_persona = mysqli_insert_id($con);

        // Insertar en la tabla entidad utilizando el ID de la persona
        $sql = mysqli_query($con, "INSERT INTO entidad(id_persona,tipo_entidad,subtipo_entidad,n_documentacion,correo_entidad, direccion,referencia, distrito, provincia, departamento,razon_social,razon_comercial, descripcion) VALUES('$id_persona','$tipo','$subtipo','$ruc','$correo','$direccion','$referencia','$distrito','$provincia','$departamento','$social','$comercial','$descripcion')");

        if ($sql) {
            $mensaje = "Datos de entidad proveedor registrados correctamente.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al insertar datos del proveedor.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else if (isset($_POST['cliente_juridico'])) {

    // persona
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];


    // entidad
    $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
    $subtipo = mysqli_real_escape_string($con, $_POST['subtipo']);
    $ruc = mysqli_real_escape_string($con, $_POST['ruc']);
    $social = mysqli_real_escape_string($con, $_POST['rsocial']);
    $comercial = mysqli_real_escape_string($con, $_POST['rcomercial']);
    $direccion = mysqli_real_escape_string($con, $_POST['direccion']);
    $referencia = mysqli_real_escape_string($con, $_POST['referencia']);
    $distrito = mysqli_real_escape_string($con, $_POST['distrito']);
    $provincia = mysqli_real_escape_string($con, $_POST['provincia']);
    $departamento = mysqli_real_escape_string($con, $_POST['departamento']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    $existe_correo = mysqli_query($con, "SELECT * FROM entidad WHERE correo_entidad='$correo'");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    // Verificar si el RUC ya existe en la base de datos
    $verificar_ruc = mysqli_query($con, "SELECT n_documentacion from entidad where n_documentacion='$ruc'");
    $verificar_comercial = mysqli_query($con, "SELECT razon_comercial from entidad where  razon_comercial='$comercial'");

    if (mysqli_num_rows($verificar_ruc) > 0) {
        $mensaje = "El ruc $ruc ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else if (mysqli_num_rows($verificar_comercial) > 0) {
        $mensaje = "El nombre comercial '$comercial' ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        // Insertar en la tabla persona
        $insert_persona = mysqli_query($con, "INSERT INTO persona(celular_persona,telefono_persona) VALUES('$celular','$telefono')");

        // Obtener el ID de la persona recién insertada
        $id_persona = mysqli_insert_id($con);

        // Insertar en la tabla entidad utilizando el ID de la persona
        $sql = mysqli_query($con, "INSERT INTO entidad(id_persona,tipo_entidad,subtipo_entidad,n_documentacion,correo_entidad, direccion,referencia, distrito, provincia, departamento,razon_social,razon_comercial, descripcion) VALUES('$id_persona','$tipo','$subtipo','$ruc','$correo','$direccion','$referencia','$distrito','$provincia','$departamento','$social','$comercial','$descripcion')");

        if ($sql) {
            $mensaje = "Datos de entidad juridico registrados correctamente.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al insertar datos juridicos.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else if (isset($_POST['cliente_natural'])) {

    //registrar persona
    $nombres = mysqli_escape_string($con, $_POST['nombres']);
    $unoapellido = mysqli_escape_string($con, $_POST['apellido_paterno']);
    $dosapellido = mysqli_escape_string($con, $_POST['apellido_materno']);
    $celular = mysqli_escape_string($con, $_POST['celular']);
    $correo = mysqli_escape_string($con, $_POST['correo']);

    //registrar cliente natural
    $tipo = mysqli_escape_string($con, $_POST['tipo']);
    $subtipo = mysqli_escape_string($con, $_POST['subtipo']);
    $dni = mysqli_escape_string($con, $_POST['dni']);
    $departamento = mysqli_escape_string($con, $_POST['departamento']);

    $existe_correo = mysqli_query($con, "SELECT * FROM entidad WHERE correo_entidad='$correo'");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    // Verificar si el RUC ya existe en la base de datos
    $verificar = mysqli_query($con, "SELECT n_documentacion from entidad where n_documentacion='$dni'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "El dni $dni ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        // Realizar la actualización de los datos
        $sql = mysqli_query($con, "INSERT INTO persona(nombres, priapellido_persona, segapellido_persona,celular_persona) VALUES('$nombres','$unoapellido','$dosapellido','$celular')");

        $id_persona = mysqli_insert_id($con);

        // Insertar en la tabla entidad utilizando el ID de la persona
        $sql = mysqli_query($con, "INSERT INTO entidad(id_persona,tipo_entidad,subtipo_entidad, n_documentacion,correo_entidad,departamento) VALUES('$id_persona','$tipo','$subtipo','$dni','$correo','$departamento')");

        if ($sql) {
            $mensaje = "Datos de entidad natural registrados correctamente.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al  registrar datos de entidad natural.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "Error al insertar datos del ajax.";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
