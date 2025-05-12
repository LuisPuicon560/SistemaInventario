<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['nombre_subcat'];

    $verificar = mysqli_query($con, "SELECT nombre_subcategoria FROM subcategoria WHERE nombre_subcategoria = '$subcategoria'");
    // Verificar si ya existe la misma subcategoría
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La subcategoría '$subcategoria' ya existe. Por favor, elija otro nombre de subcategoría.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insertar_subcategoria = mysqli_query($con, "INSERT INTO subcategoria(nombre_subcategoria,id_categoria) VALUES ('$subcategoria','$categoria')");
        if ($insertar_subcategoria) {
            $mensaje = "Subcategoria registrada.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al registrar subcategoria.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "Error al recibir datos del ajax.";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}

mysqli_close($con);
