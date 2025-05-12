<?php
include '../conexion.php';
include '../contenido/welcome.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../contenido/head.php'); ?>
    <title>Registrar de Usuario</title>
</head>
<style>
    /* Agrega algún estilo si lo deseas */
    .eye-icon {
        cursor: pointer;
    }
</style>

<body>
    <?php include('../contenido/menu.php'); ?>
    <div class="container">
        <h1 class="text-center my-5">Registrar Usuario</h1>
        <form action="../crud/agregar_usuario.php" method="POST" class="text-center my-5" id="formulario_usuario">
            <div class="row">
                <div class="col-7 col-sm-8 col-md-8 col-lg-8 col-xl-6 col-xxl-6 mx-auto">
                    <label for="dni" class="form-label d-flex">Dni</label>
                    <input type="text" name="dni" class="form-control dni" maxlength="8">
                    <label for="nombres" class="form-label d-flex">Nombres</label>
                    <input type="text" name="nombres" class="form-control nombres" disabled>
                    <label for="apellido_paterno" class="form-label d-flex">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" class="form-control apellido_paterno" disabled>
                    <label for="apellido_materno" class="form-label d-flex">Apellido Materno</label>
                    <input type="text" name="apellido_materno" class="form-control apellido_materno" disabled>
                    <label for="celular" class="form-label d-flex">Celular</label>
                    <input type="text" name="celular" class="form-control celular" maxlength="9">
                    <label for="correo" class="form-label d-flex">Correo Electronico</label>
                    <input type="text" name="correo" class="form-control correo">
                    <label for="usuario" class="form-label d-flex">Usuario</label>
                    <input type="text" name="usuario" class="form-control usuario">
                    <label for="contrasena" class="form-label d-flex">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="contrasena" class="form-control contrasena" id="contrasena">
                        <span class="input-group-btn border rounded-end">
                            <button type="button" class="btn btn-default toggle-password" id="togglePassword">
                                <span id="showPasswordIcon"><i class="bi bi-eye"></i></span>
                                <span id="hidePasswordIcon" style="display:none;"><i class="bi bi-eye-slash"></i></span>
                            </button>
                        </span>
                    </div>
                    <label for="rol" class="form-label d-flex">Rol</label>
                    <select name="roles" id="roles" class="form-select">
                        <?php
                        include '../conexion.php';
                        $sql = "SELECT r.* FROM roles r";
                        $resultado = mysqli_query($con, $sql);
                        while ($row = $resultado->fetch_assoc()) {
                            echo "<option value='" . $row['id_rol'] . "'>" . $row['usuario_rol'] . "</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="registrar_usuario" class="btn btn-info text-center my-3">Enviar</button>
                    <a href="./lista_usuario.php" class="btn btn-danger text-center">Atras</a>
                </div>
            </div>
        </form>
    </div>
    <?php include '../contenido/footer.php'; ?>
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


        $(".dni").on('change', function() {
            let n_documento = $(this).val();
            let n_info;


            if (n_documento.length >= 8) {
                n_info = 'dni';
                $.ajax({
                    type: "POST",
                    url: "../crud/api_sunat.php",
                    data: {
                        n_info: n_info,
                        n_documento: n_documento
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            // Actualiza los campos del formulario con la respuesta de la API
                            $(".nombres").val(response.nombres);
                            $(".apellido_paterno").val(response.apellidoPaterno);
                            $(".apellido_materno").val(response.apellidoMaterno);
                        } else {
                            console.error("La respuesta de la API no contiene la información esperada.");
                        }
                    }
                });
            }

        });

        $(document).ready(function() {
            $('#formulario_usuario').submit(function(e) {
                e.preventDefault();
                // dentro de ^ se encuentran las validaciones
                let expDni = /^[0-9]{8}$/;
                let dni = $('.dni').val();
                let expCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                let correo = $('.correo').val();
                let expCelular = /^[0-9]{9}$/;
                let celular = $('.celular').val();
                let expuser = /^[a-zA-Z0-9_-]{4,20}$/;
                let user = $('.usuario').val();
                let expass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
                let pass = $('.contrasena').val();
                if (dni === '') {
                    ErrorAlert("Debes ingresar un número de DNI");
                } else if (!expDni.test(dni)) {
                    ErrorAlert("Ingresa un número de DNI válido");
                } else if (celular === '') {
                    ErrorAlert("Debes ingresar un numero de celular");
                } else if (!expCelular.test(celular)) {
                    ErrorAlert("Debes ingresar un numero valido");
                } else if (correo === '') {
                    ErrorAlert("Debes ingresar un correo");
                } else if (!correo.includes('@')) {
                    ErrorAlert("Ingresa un correo con un dominio válido (por ejemplo @gmail, @outlook, @otrodominio)");
                } else if (!expCorreo.test(correo)) {
                    ErrorAlert("Ingresa un correo válido");
                } else if (user === '') {
                    ErrorAlert("Debes crear un nuevo usuario");
                } else if (!expuser.test(user)) {
                    ErrorAlert("El usuario debe tener entre 4 y 20 caracteres alfanuméricos, guiones bajos o guiones");
                } else if (pass === '') {
                    ErrorAlert("Debes ingresar una contraseña");
                } else if (!expass.test(pass)) {
                    ErrorAlert("La contraseña debe tener al menos 8 caracteres, con al menos una letra y un número");
                } else {
                    Swal.fire({
                        title: "¿Quíeres registrar a este usuario?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // datos que se incluye:
                            let nombres = $(".nombres").val();
                            let apellido_paterno = $(".apellido_paterno").val();
                            let apellido_materno = $(".apellido_materno").val();
                            let rol = $("#roles").val();

                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_usuario.php',
                                data: {
                                    dni: dni,
                                    nombres: nombres,
                                    apellido_paterno: apellido_paterno,
                                    apellido_materno: apellido_materno,
                                    celular: celular,
                                    correo: correo,
                                    usuario: user,
                                    contrasena: pass,
                                    roles: rol

                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Registrado",
                                            icon: "success",
                                            text: response.mensaje
                                        });
                                        $('.dni').val('');
                                        $('.nombres').val('');
                                        $('.apellido_paterno').val('');
                                        $('.apellido_materno').val('');
                                        $('.celular').val('');
                                        $('.correo').val('');
                                        $('.usuario').val('');
                                        $('.contrasena').val('');
                                    } else {
                                        console.log(response)
                                        Swal.fire({
                                            title: "Error de insercion",
                                            icon: "error",
                                            text: response.mensaje // Utiliza el mensaje de la respuesta JSON
                                        });
                                    }
                                }

                            });
                        }
                    });
                }

                function ErrorAlert(fallo) {
                    Swal.fire({
                        icon: "error",
                        title: fallo,
                    });
                }

            });

        });
    </script>
</body>

</html>