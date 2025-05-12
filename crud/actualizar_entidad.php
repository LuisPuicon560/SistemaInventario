<?php
require '../conexion.php';

if (isset($_POST['proveedor_proveedor'])) {
    $id_entidad = mysqli_real_escape_string($con, $_POST['idEntidad']);
    $id_persona = mysqli_real_escape_string($con, $_POST['idPersona']);
    $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
    $subtipo = mysqli_real_escape_string($con, $_POST['subtipo']);
    $ruc = mysqli_real_escape_string($con, $_POST['ruc']);
    $social = mysqli_real_escape_string($con, $_POST['rsocial']);
    $comercial = mysqli_real_escape_string($con, $_POST['rcomercial']);
    $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
    $celular = mysqli_real_escape_string($con, $_POST['celular']);
    $correo = mysqli_real_escape_string($con, $_POST['correo']);
    $direccion = mysqli_real_escape_string($con, $_POST['direccion']);
    $referencia = mysqli_real_escape_string($con, $_POST['referencia']);
    $distrito = mysqli_real_escape_string($con, $_POST['distrito']);
    $provincia = mysqli_real_escape_string($con, $_POST['provincia']);
    $departamento = mysqli_real_escape_string($con, $_POST['departamento']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    $existe_correo = mysqli_query($con, "SELECT * FROM entidad WHERE correo_entidad='$correo' and id_entidad!=$id_entidad");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }


    $verificar = mysqli_query($con, "SELECT * from entidad where n_documentacion='$ruc' and id_entidad !='$id_entidad'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "El ruc $ruc que estas intentando actualizar ya existe en algun proveedor o juridico ";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insert_persona = mysqli_query($con, "UPDATE persona SET celular_persona='$celular',telefono_persona='$telefono' where id_persona='$id_persona'");

        if ($insert_persona > 0) {

            $insert_entidad = mysqli_query($con, "UPDATE entidad SET id_persona='$id_persona',  tipo_entidad='$tipo',subtipo_entidad='$subtipo', n_documentacion='$ruc', correo_entidad='$correo', direccion='$direccion',referencia='$referencia',distrito='$distrito',provincia='$provincia', departamento='$departamento',razon_social='$social',razon_comercial='$comercial',  descripcion='$descripcion' WHERE id_entidad='$id_entidad'");
            if ($insert_entidad > 0) {
                $mensaje = "Datos actualizados correctamente.";
                echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
                exit();
            } else {
                $mensaje = "Error al actualizar entidad.";
                echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                exit();
            }
        } else {
            $mensaje = "Error al actualizar persona.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else if (isset($_POST['cliente_juridico'])) {
    $id_entidad = mysqli_real_escape_string($con, $_POST['idEntidad']);
    $id_persona = mysqli_real_escape_string($con, $_POST['idPersona']);
    $tipo = mysqli_real_escape_string($con, $_POST['tipo']);
    $subtipo = mysqli_real_escape_string($con, $_POST['subtipo']);
    $ruc = mysqli_real_escape_string($con, $_POST['ruc']);
    $social = mysqli_real_escape_string($con, $_POST['rsocial']);
    $comercial = mysqli_real_escape_string($con, $_POST['rcomercial']);
    $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
    $celular = mysqli_real_escape_string($con, $_POST['celular']);
    $correo = mysqli_real_escape_string($con, $_POST['correo']);
    $direccion = mysqli_real_escape_string($con, $_POST['direccion']);
    $referencia = mysqli_real_escape_string($con, $_POST['referencia']);
    $distrito = mysqli_real_escape_string($con, $_POST['distrito']);
    $provincia = mysqli_real_escape_string($con, $_POST['provincia']);
    $departamento = mysqli_real_escape_string($con, $_POST['departamento']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    $existe_correo = mysqli_query($con, "SELECT * FROM entidad WHERE correo_entidad='$correo' and id_entidad!=$id_entidad");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar = mysqli_query($con, "SELECT * from entidad where n_documentacion='$ruc' and id_entidad !='$id_entidad'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "El ruc $ruc que estas intentando actualizar ya existe en algun proveedor o juridico ";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insert_persona = mysqli_query($con, "UPDATE persona SET celular_persona='$celular',telefono_persona='$telefono' where id_persona='$id_persona'");

        if ($insert_persona > 0) {

            $insert_entidad = mysqli_query($con, "UPDATE entidad SET id_persona='$id_persona',  tipo_entidad='$tipo',subtipo_entidad='$subtipo', n_documentacion='$ruc',correo_entidad='$correo', direccion='$direccion',referencia='$referencia',distrito='$distrito',provincia='$provincia', departamento='$departamento',razon_social='$social',razon_comercial='$comercial',  descripcion='$descripcion' WHERE id_entidad='$id_entidad'");
            if ($insert_entidad > 0) {
                $mensaje = "Datos actualizados correctamente.";
                echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
                exit();
            } else {
                $mensaje = "Error al actualizar entidad.";
                echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                exit();
            }
        } else {
            $mensaje = "Error al actualizar persona.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else if (isset($_POST['cliente_natural'])) {

    $id_entidad = $_POST['idEntidad'];
    $id_persona = $_POST['idPersona'];
    $dni = $_POST['dni'];
    $tipo = $_POST['tipo'];
    $subtipo = $_POST['subtipo'];
    $nombres = $_POST['nombres'];
    $priapellido = $_POST['apellido_paterno'];
    $segapellido = $_POST['apellido_materno'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $departamento = $_POST['departamento'];

    $existe_correo = mysqli_query($con, "SELECT * FROM entidad WHERE correo_entidad='$correo' and id_entidad!=$id_entidad");
    if (mysqli_num_rows($existe_correo) > 0) {
        $mensaje = "El correo electronico $correo ya existe";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar = mysqli_query($con, "SELECT * from entidad where n_documentacion='$dni' and id_entidad !='$id_entidad'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "El dni $dni que estas intentando actualizar ya existe entre los dni existentes";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insert_persona = mysqli_query($con, "UPDATE persona SET nombres='$nombres',priapellido_persona='$priapellido',segapellido_persona='$segapellido', celular_persona='$celular' where id_persona='$id_persona'");

        if ($insert_persona > 0) {
            $insert_entidad = mysqli_query($con, "UPDATE entidad SET id_persona='$id_persona',  tipo_entidad='$tipo',subtipo_entidad='$subtipo', n_documentacion='$dni',  correo_entidad='$correo', razon_social='', direccion='', referencia='',distrito='',provincia='', departamento='$departamento',razon_comercial='', descripcion='' WHERE id_entidad='$id_entidad'");
            if ($insert_entidad > 0) {
                $mensaje = "Datos de la entidad natural actualizados correctamente.";
                echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
                exit();
            } else {
                $mensaje = "Error al editar datos de la entidad del natural";
                echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                exit();
            }
        } else {
            $mensaje = "Error al actualizar persona para naturl";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "Error al insertar datos del ajax.";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
