<?php
session_start();
include '../conexion.php';

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = $_GET['id'];
    $estado = $_GET['estado'];

    $sql = "UPDATE entidad SET estado=$estado WHERE id_entidad='" . $id . "'";
    $resultado = mysqli_query($con, $sql);
    mysqli_close($con);

    if ($resultado) {
        header('location:../entrada/lista_natural.php');
    } else {
        header('location:../entrada/lista_natural.php');
    }
}
