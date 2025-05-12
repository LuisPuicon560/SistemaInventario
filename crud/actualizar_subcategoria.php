<?php
// session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // obtenemos el id que pertenece tanto a su nombre como su foranea
    $idsubcategoria = $_POST['idsubcategoria'];
    // obtenemos el id de categoria para cambiar
    $idcategoria = $_POST['idcategoria'];
    // obtenemos el dato para actualizar bajo las dos especificaciones anterioes
    $nombre_subcategoria = $_POST['nombre_subcat'];

    $consulta_cambios = mysqli_query($con, "SELECT * FROM subcategoria WHERE nombre_subcategoria = '$nombre_subcategoria' and id_categoria = $idcategoria and id_subcategoria='$idsubcategoria'");

    if (mysqli_num_rows($consulta_cambios) > 0) {
        $mensaje = "No hubo cambios.";
        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar = mysqli_query($con, "SELECT * FROM subcategoria WHERE nombre_subcategoria='$nombre_subcategoria' and id_subcategoria!= $idcategoria ");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La subcategoria $nombre_subcategoria ya existe. Por favor elegir otro nombre";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $sql = "UPDATE subcategoria SET nombre_subcategoria='$nombre_subcategoria',id_categoria=$idcategoria WHERE id_subcategoria=$idsubcategoria ";
        $resultado = mysqli_query($con, $sql);
        if ($resultado) {
            $mensaje = "Subcategoria actualizada.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar subcategoria.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $ver = mysqli_query($con, "SELECT * FROM subcategoria WHERE nombre_subcategoria=$nombre_subcategoria");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La subcategoria '$nombre_subcategoria' ya esta siendo usada en otra categoria";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }
}
