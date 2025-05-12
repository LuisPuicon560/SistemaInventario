<?php

require '../conexion.php';

$id = $con->real_escape_string($_POST['id']);

$sql = "SELECT id_categoria, nombre_categoria
        FROM categoria
        WHERE id_categoria = $id
        LIMIT 1";
$resultado = $con->query($sql);
$rows = $resultado->num_rows;

$categoria = [];

if ($rows > 0) {
    $categoria = $resultado->fetch_array();
}
echo json_encode($categoria, JSON_UNESCAPED_UNICODE);
