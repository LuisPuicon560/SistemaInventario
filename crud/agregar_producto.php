<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modelo = $_POST['idmodelo'];
    $producto = $_POST['codigo'];
    $producto = preg_replace('/\s+/', ' ', $producto);


    $verificar = mysqli_query($con, "SELECT codigo_referencia FROM producto WHERE codigo_referencia = '$producto'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "El producto $producto ya existe. Eliga otro nombre para el codigo de producto";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $insertar_producto = mysqli_query($con, "INSERT INTO producto(codigo_referencia,id_modelo) VALUES ('$producto',$modelo)");
        if ($insertar_producto) {
            $mensaje = "Producto registrada.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Erro al registrar producto.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
}else{
    $mensaje = "Error al obtener datos del ajax.";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}



$_SESSION['mensaje'] = $mensaje;
header('Location: ../entrada/producto.php');
exit();
mysqli_close($con);
