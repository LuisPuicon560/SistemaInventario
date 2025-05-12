<?php
// session_start();
include("../conexion.php");
include("../contenido/welcome.php");
$idusuario = $_SESSION['id_user'];
$config = mysqli_query($con, "SELECT * FROM configuracion");
$usuario = mysqli_query($con, "SELECT u.*,p.*,r.* FROM persona p INNER JOIN usuario u ON p.id_persona= u.id_persona INNER JOIN roles r ON r.id_rol= u.id_rol  where id_usuario ='$idusuario'");
$rpta_config = mysqli_num_rows($config);
$rpta_user = mysqli_num_rows($usuario);

if ($rpta_config == 0 || $rpta_user == 0) {
    $_SESSION['mensaje'] = "No es posible obtener datos del servidor";
    header('location: ./index.php');
} else {

    while ($data = mysqli_fetch_array($usuario)) {
        $nombre = $data['nombres'];
        $apellido = $data['priapellido_persona'];
        $correo = $data['correo_usuario'];
        $telefono = $data['telefono_persona'];
        $user = $data['user_usuario'];
        $roles = $data['usuario_rol'];
    }
    while ($data = mysqli_fetch_array($config)) {
        $ruc = $data['ruc'];
        $telefono = $data['telefono'];
        $email = $data['email'];
        $razon_social = $data['razon_social'];
        $comercial = $data['nombre_comercial'];
        $direccion = $data['Direccion'];
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
</head>
<body>
    <?php include '../contenido/menu.php'; ?>
    <?php include '../contenido/mensaje.php'; ?>
    <h1 class="text-center my-5">Inversiones Mega</h1>
    <div class="row d-flex justify-content-between mx-5">
        <div class="col-sm-12 col-xl-6">
            <h2 class="text-center">Informacion de Empresa</h2>
            <div class="text-center my-4">
                <img src="../diseño/img/logo.png" width="250px" alt="logo">
            </div>
            <form class="col-sm-10 col-md-10 col-xl-10 col-xxl-8 mx-auto">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6 col-xxl-6">
                        <label for="" class="form-label">Ruc</label>
                        <input type="text" class="form-control" value="<?= $ruc ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 col-xxl-6">
                        <label for="" class="form-label">Telefono</label>
                        <input type="text" class="form-control" value="<?= $telefono ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-12 col-xxl-12">
                        <label for="" class="form-label">Correo Electronico</label>
                        <input type="text" class="form-control" value="<?= $correo ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Razon social</label>
                        <input type="text" class="form-control" value="<?= $razon_social ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Nombre comercial</label>
                        <input type="text" class="form-control" value="<?= $comercial ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-label">Direccion</label>
                        <input type="text" class="form-control" value="<?= $direccion ?>" readonly>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-sm-12 col-xl-6">
            <h2 class="text-center">Informacion de Usuario</h2>
            <div class="text-center my-4">
                <img src="../diseño/img/perfil.png" width="230px" alt="usuario">
            </div>
            <div class="col-sm-10 col-md-10 col-xl-9 mx-auto">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <label for="" class="form-label">Nombres</label>
                        <input type="text" class="form-control" value="<?= $nombre ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <label for="" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="<?= $apellido ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xl-4">
                        <label for="" class="form-label">Telefono</label>
                        <input type="text" class="form-control" value="<?= $telefono ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-8 col-xl-8">
                        <label for="" class="form-label">Correo Electronico</label>
                        <input type="text" class="form-control" value="<?= $correo ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <label for="" class="form-label">Usuario</label>
                        <input type="text" class="form-control" value="<?= $user ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <label for="" class="form-label">Rol</label>
                        <input type="text" class="form-control" value="<?= $roles ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-8 my-1 mx-auto px-2 d-flex justify-content-center">
                    <h3 class="my-2 text-center">Nuevo Token:</h3>
                    <div class="text-center">
                        <form action="cambiar_token.php" method="post">
                            <div class="col-8 mx-auto">
                                <input type="text" id="nuevo_token" name="nuevo_token" class="form-control" required>
                            </div>
                            <div class="col-4 mx-auto my-2">
                                <button type="submit" class="btn btn-warning">Actualizar Token</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../contenido/footer.php'; ?>

</body>

</html>