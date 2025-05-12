<?php
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idmarca = $_POST['idmarca'];
    $nombre_familia = $_POST['nombre_serie'];
    $nombre_familia = preg_replace('/\s+/', ' ', $nombre_familia); // Reemplazar múltiples espacios con uno solo

    $verificar = mysqli_query($con, "SELECT nombre_familia FROM familia WHERE LOWER(TRIM(nombre_familia)) = '$nombre_familia'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La marca $nombre_familia ya existe. Por favor elegir otro nombre";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insertar_familia = mysqli_query($con, "INSERT INTO familia(nombre_familia,id_marca) VALUES ('$nombre_familia','$idmarca')");
        if ($insertar_familia) {
            $mensaje = "Serie registrada";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al registrar la serie";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
}
