<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idmarca = $_POST['idmarca'];
    $idfamilia = $_POST['idfamilia'];
    $nombre_familia = $_POST['nombre_serie'];
    $nombre_familia = preg_replace('/\s+/', ' ', $nombre_familia); // Reemplazar múltiples espacios con uno solo

    $consulta_cambios = mysqli_query($con, "SELECT * FROM familia WHERE nombre_familia = '$nombre_familia' and id_marca=$idmarca and id_familia =$idfamilia");

    if (mysqli_num_rows($consulta_cambios) > 0) {
        $mensaje = "No hubo cambios.";
        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
        exit();
    }

    //  si existe entre todos los datos, la misma $nombre_familia y misma $idmarca
    $verificar = mysqli_query($con, "SELECT * FROM familia WHERE  LOWER(TRIM(nombre_familia))='$nombre_familia' and id_familia!=$idfamilia");


    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La serie $nombre_familia ya existe con la marca elegida. Por favor elegir otra serie";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $sql = "UPDATE familia SET nombre_familia='$nombre_familia',id_marca='$idmarca' WHERE id_familia='$idfamilia' ";
        $resultado = mysqli_query($con, $sql);
        mysqli_close($con);
        if ($resultado) {
            $mensaje = "La serie ha sido actualizado";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar serie.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "No se pudo obtener los datos de la serie";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
