<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idfamilia = $_POST['idfamilia'];
    $nombre_modelo = $_POST['nombre_modelo'];
    $descripcion_modelo = $_POST['descripcion_modelo'];

    $nombre_modelo = preg_replace('/\s+/', ' ', $nombre_modelo);
    $descripcion_modelo = str_replace(["\r"], "\n", $descripcion_modelo);

    // Divide la descripción en líneas
    $lineas = explode("\n", $descripcion_modelo);

    // Filtra las líneas que contienen solo espacios en blanco
    $lineas = array_filter($lineas, function ($linea) {
        return trim($linea) !== '';
    });

    // Agrega "-" al principio de cada línea
    foreach ($lineas as &$linea) {
        $linea = trim(str_replace('•', '', $linea)); // Elimina viñetas y espacios en blanco adicionales
        $linea = "- " . $linea;
    }

    // Une las líneas de nuevo
    $descripcion_modelo = implode("\n", $lineas);


    $verificar_nombre = mysqli_query($con, "SELECT nombre_modelo, descripcion_modelo FROM modelo WHERE lower(nombre_modelo) = lower('$nombre_modelo')");
    $verificar_descripcion = mysqli_query($con, "SELECT descripcion_modelo FROM modelo WHERE descripcion_modelo= '$descripcion_modelo'");

    if (mysqli_num_rows($verificar_nombre) > 0) {
        $mensaje = "El modelo '$nombre_modelo' ya existe dentro de los modelos existentes";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else if (mysqli_num_rows($verificar_descripcion) > 0) {
        $mensaje = "La descripcion que intenta agregar ya existe en uno de los modelos agregados";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insertar_modelo = mysqli_query($con, "INSERT INTO modelo(nombre_modelo,descripcion_modelo,id_familia) VALUES ('$nombre_modelo','$descripcion_modelo','$idfamilia')");

        if ($insertar_modelo) {
            $mensaje = "El modelo ha sido registrado";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar el modelo";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "Error al obtener datos del ajax";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
mysqli_close($con);
