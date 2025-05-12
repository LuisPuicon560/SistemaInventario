<?php
session_start();
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idmodelo = $_POST['idmodelo'];
    $producto = $_POST['idproducto'];
    $codigo = $_POST['codigo'];
    $codigo = preg_replace('/\s+/', ' ', $codigo);

    $consulta_cambios = mysqli_query($con, "SELECT * FROM producto WHERE codigo_referencia= '$codigo' and id_modelo = $idmodelo and id_producto='$producto'");

    if (mysqli_num_rows($consulta_cambios) > 0) {
        $mensaje = "No hubo cambios.";
        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
        exit();
    }

    $verificar = mysqli_query($con, "SELECT codigo_referencia FROM producto WHERE codigo_referencia = '$codigo'");

    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = "El producto $codigo que quieres actualizar existe. Elige otro nombre para actualizar";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $sql = "UPDATE producto SET codigo_referencia='$codigo',id_modelo='$idmodelo' WHERE id_producto='$producto' ";
        $resultado = mysqli_query($con, $sql);
        if ($resultado) {
            $mensaje = "Producto actualizado.";
            echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
            exit();
        } else {
            $mensaje = "Error al actualizar producto.";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
}else{
    $mensaje = "Error al obtener los datos del ajax.";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
