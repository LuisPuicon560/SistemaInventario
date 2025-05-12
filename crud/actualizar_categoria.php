<?php
session_start();
include '../conexion.php';
if (isset($_POST['ok'])){
    $id=mysqli_escape_string($con,$_POST['id']);
    $categoria=mysqli_escape_string($con,$_POST['categoria']);
    $categoria = preg_replace('/\s+/', ' ', $categoria); 

    $verificar= mysqli_query($con,"SELECT * FROM categoria WHERE nombre_categoria= '$categoria' and id_categoria !=$id");
    if(mysqli_num_rows($verificar)){
        $mensaje = "<div class='alert alert-warning text-center'>La categoria $categoria que iba a editar ya existe.</div>";
        $_SESSION['mensaje'] = $mensaje;
        header("location:../entrada/categoria.php");
    }else{
        $sql="UPDATE categoria SET nombre_categoria='$categoria' WHERE id_categoria='$id' ";
        $resultado = $con->query($sql);
        mysqli_close($con);
        if($resultado){
            $mensaje = "<div class='alert alert-success text-center'>Categoria editada.</div>";
            $_SESSION['mensaje'] = $mensaje;
            header("location:../entrada/categoria.php");
        }else{
            $mensaje = "<div class='alert alert-warning text-center'>Error al editar.</div> ";
            $_SESSION['mensaje'] = $mensaje;
            header("location:../entrada/categoria.php");
        } 
    }
} 