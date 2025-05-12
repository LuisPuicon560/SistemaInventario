<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subcategoria = $_POST['idsubcategoria'];
    $marca = $_POST['nombre_marca'];
    $marca =mysqli_escape_string($con,$_POST['nombre_marca']); 
    $marca = preg_replace('/\s+/', ' ', $marca);

    // Verifica si el campo de la  está definido y no está vacío
    $verificar = mysqli_query($con, "SELECT nombre_marca FROM marca WHERE LOWER(nombre_marca) = LOWER('$marca') AND id_subcategoria = $subcategoria");

    // Verificar si ya existe la misma marca dentro de la subcategoria
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "La marca $marca que intentó registrar, ya existe dentro de una subcategoria";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insertar_marca = mysqli_query($con, "INSERT INTO marca(nombre_marca,id_subcategoria) VALUES ('$marca','$subcategoria')");
        if ($insertar_marca) {
            $mensaje = "La marca ha sido registrada";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al editar la marca";
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
