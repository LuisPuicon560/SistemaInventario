<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idfamilia = $_POST['idfamilia'];
    $idmodelo = $_POST['idmodelo'];
    $nombre_modelo = $_POST['nombre_modelo'];
    $descripcion = $_POST['descripcion_modelo'];

    $nombre_modelo = preg_replace('/\s+/', ' ', $nombre_modelo);
    $descripcion = str_replace(["\r"], "\n", $descripcion);


    // Divide la descripción en líneas
    $lineas = explode("\n", $descripcion);

    // Filtra las líneas que contienen solo espacios en blanco o están vacías
    $lineas = array_filter($lineas, function ($linea) {
        return trim($linea) !== '';
    });

    // Verifica cada línea y agrega "-" al principio si no está presente
    foreach ($lineas as &$linea) {
        $linea = trim(str_replace('•', '', $linea)); // Elimina viñetas y espacios en blanco adicionales
        if (strpos($linea, '-') !== 0) {
            $linea = "- " . $linea;
        }
    }

    // Une las líneas de nuevo
    $descripcion = implode("\n", $lineas);


    $consulta_cambios = mysqli_query($con, "SELECT * FROM modelo WHERE nombre_modelo = '$nombre_modelo' and id_familia = $idfamilia and id_modelo='$idmodelo' and descripcion_modelo='$descripcion'");

    if (mysqli_num_rows($consulta_cambios) > 0) {
        $mensaje = "No hubo cambios.";
        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar_nombre = mysqli_query($con, "SELECT * FROM modelo WHERE nombre_modelo='$nombre_modelo' and id_modelo!=$idmodelo");
    $verificar_descripcion = mysqli_query($con, "SELECT * FROM modelo WHERE  descripcion_modelo='$descripcion' and id_modelo!=$idmodelo");

    if (mysqli_num_rows($verificar_nombre) > 0) {
        $mensaje = "El modelo $nombre_modelo y la caracteristicas seleccionadas ya existen. Elegir otro nombre";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else if (mysqli_num_rows($verificar_descripcion) > 0) {
        $mensaje = "La descripcion que intenta agregar ya existe en uno de los modelos agregados";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $sql = "UPDATE modelo SET nombre_modelo='$nombre_modelo',descripcion_modelo='$descripcion',id_familia='$idfamilia' WHERE id_modelo='$idmodelo'";
        $resultado = mysqli_query($con, $sql);
        mysqli_close($con);

        if ($resultado) {
            $mensaje = "El modelo ha sido actualizado";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar modelo";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "Error al recibir datos del ajax.";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
