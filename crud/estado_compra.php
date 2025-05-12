<?php
session_start();
include '../conexion.php';

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = $_GET['id'];
    $estado = $_GET['estado'];

    $consulta = mysqli_query($con, "SELECT id_producto, cantidad_detc FROM detalle_compra WHERE id_compra = $id ");
    while ($obtener = mysqli_fetch_assoc($consulta)) {
        $producto = $obtener['id_producto'];
        $cantidad = $obtener['cantidad_detc'];
        $elimina_producto = mysqli_query($con, "UPDATE producto SET stock_actual= stock_actual - $cantidad WHERE id_producto = $producto");
    }

    $sql = "UPDATE compra SET estado=$estado WHERE id_compra='" . $id . "'";

    $resultado = mysqli_query($con, $sql);
    mysqli_close($con);

    if ($resultado) {
        header('location:../entrada/lista_compra.php');
    } else {
        header('location:../entrada/lista_compra.php');
    }
}
