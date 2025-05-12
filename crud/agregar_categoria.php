<?php 
session_start();
include '../conexion.php';

$categoria = $_POST['categoria'];
$categoria = preg_replace('/\s+/', ' ', $categoria);


if (empty($categoria)) {
    $_SESSION['mensaje'] = "<div class='alert alert-warning text-center'>El campo 'categoria' no puede estar vacío.</div>";
    header('location: ../entrada/categoria.php');
} else {
    $verificar = mysqli_query($con, "SELECT nombre_categoria FROM categoria WHERE nombre_categoria = '$categoria'");
    if (mysqli_num_rows($verificar) > 0) {
        $_SESSION['mensaje'] = "<div class='alert alert-warning text-center'>La categoría '$categoria' ya existe. Por favor, elija otro nombre de categoria.</div>";
        header('location: ../entrada/categoria.php');
    } else {
        $insertar_categoria = mysqli_query($con, "INSERT INTO categoria(nombre_categoria) VALUES ('$categoria')");
        mysqli_close($con);
        if ($insertar_categoria) {
            $_SESSION['mensaje'] = "<div class='alert alert-success text-center'>Categoría creada.</div>";
            header('location: ../entrada/categoria.php');
            exit();
        }
    }
}

?>
