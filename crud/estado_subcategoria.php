<?php
session_start();
include '../conexion.php';

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = $_GET['id'];
    $estado = $_GET['estado'];

    $sql = "UPDATE subcategoria SET estado=$estado WHERE id_subcategoria='" . $id . "'";
    $resultado = mysqli_query($con, $sql);

    if ($resultado) {
        header('location:../entrada/lista_subcategoria.php');
    } else {
        header('location:../entrada/lista_subcategoria.php');
    }
}
