<?php
include '../conexion.php';

$id = $con->real_escape_string($_POST['getEntidad']);

$sql = "SELECT p.*, e.*
FROM entidad e
INNER JOIN persona p ON p.id_persona = e.id_persona
WHERE e.id_entidad='$id'";

$resultado = $con->query($sql);
$entidad = [];

if ($resultado) {
    $entidad = $resultado->fetch_array();
}

echo json_encode($entidad, JSON_UNESCAPED_UNICODE);
