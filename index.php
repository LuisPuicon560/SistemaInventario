<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./diseño/bootstrap/css/bootstrap.min.css">
    <script src="./diseño/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./diseño/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="diseño/img/logo.png" type="image/x-icon">
    <title>Inversiones de Bienes y Servicios MEGA</title>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-10 d-flex flex-direction-row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="row">
                    <div class="text-center mb-4 my-5">
                        <img src="./diseño/img/logo.png" alt="logo" width="317px">
                        <h1> Inversiones Mega</h1>
                    </div>
                    <div class="row">
                        <div class="col-6 mx-auto">
                            <?php include('contenido/mensaje.php'); ?>
                        </div>
                    </div>
                    <div class="col-6 mx-auto my-4">
                        <h2 class="text-center mb-4 ">Inicio de Sesión</h2>
                        <form action="crud/inicio_usuario.php" method="POST" id="formInicioSesion">
                            <div class="form-group">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control usuario" name="usuario">
                                <div class="text-center alert alert-info div_usuario" style='display:none'>El usuario no debe dejarse vacio</div>
                            </div>
                            <div class="form-group">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="contrasena" class="form-control contrasena" id="contrasena">
                                    <span class="input-group-btn border rounded-end">
                                        <button type="button" class="btn btn-default toggle-password" id="togglePassword">
                                            <span id="showPasswordIcon"><i class="bi bi-eye"></i></span>
                                            <span id="hidePasswordIcon" style="display:none;"><i class="bi bi-eye-slash"></i></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <a href="entrada/verificacion.php">¿Olvidaste tu contraseña?</a>
                            <button class="btn btn-primary form-control my-4" type="submit" name="login">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="diseño/jquery-3.7.1.min.js"></script>
    <script src="./diseño/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#togglePassword").click(function() {

            let passwordInput = $("#contrasena");
            let showPasswordIcon = $("#showPasswordIcon");
            let hidePasswordIcon = $("#hidePasswordIcon");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                showPasswordIcon.hide();
                hidePasswordIcon.show();
            } else {
                passwordInput.attr("type", "password");
                showPasswordIcon.show();
                hidePasswordIcon.hide();
            }

        });
    </script>
</body>

</html>