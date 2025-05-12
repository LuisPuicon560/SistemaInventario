<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // obtenemos el id que pertenece tanto a su nombre como su foranea
    $idmarca = $_POST['idmarca'];
    // obtenemos el id de categoria para cambiar
    $idsubcategoria = $_POST['idsubcategoria'];
    // obtenemos el dato para actualizar bajo las dos especificaciones anterioes
    $nombre_marca = $_POST['nombre_marca'];
    $nombre_marca = preg_replace('/\s+/', ' ', $nombre_marca);

    $consulta_cambios = mysqli_query($con, "SELECT * FROM marca WHERE nombre_marca = '$nombre_marca' and id_subcategoria = $idsubcategoria and id_marca='$idmarca'");

    if (mysqli_num_rows($consulta_cambios) > 0) {
        $mensaje = "No hubo cambios.";
        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar = mysqli_query($con, "SELECT * FROM marca WHERE  LOWER(nombre_marca)= LOWER('$nombre_marca') and id_subcategoria =$idsubcategoria");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La marca $nombre_marca ya existe dentro de la subcategoria elegida.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $sql = "UPDATE marca SET nombre_marca='$nombre_marca',id_subcategoria='$idsubcategoria' WHERE id_marca='$idmarca' ";
        $resultado = mysqli_query($con, $sql);
        mysqli_close($con);
        if ($resultado) {
            $mensaje = "Marca actualizada.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar marca.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} 