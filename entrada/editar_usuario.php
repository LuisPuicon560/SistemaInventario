<?php
include '../conexion.php';
include '../contenido/welcome.php';
if (empty($_GET['id'])) {
    header('location: lista_usuario.php');
}

$id_usuario = $_GET['id'];

$getUsuario = mysqli_query($con, "SELECT p.*,u.*,r.* FROM usuario u INNER JOIN persona p ON p.id_persona = u.id_persona INNER JOIN roles r ON r.id_rol = u.id_rol WHERE id_usuario='$id_usuario'");
mysqli_close($con);
$resultados = mysqli_num_rows($getUsuario);

if ($resultados == 0) {
    $_SESSION['mensaje'] = "No es posible editar";
    header('location: ./lista_usuario.php');
} else {
    while ($data = mysqli_fetch_array($getUsuario)) {
        $idpersona = $data['id_persona'];
        $idusuario = $data['id_usuario'];
        $idrol = $data['id_rol'];
        $dni = $data['dni_usuario'];
        $namenombres = $data['nombres'];
        $namepriapellido = $data['priapellido_persona'];
        $namesegapellido = $data['segapellido_persona'];
        $celular = $data['celular_persona'];
        $correo = $data['correo_usuario'];
        $user = $data['user_usuario'];
        $rol = $data['usuario_rol'];
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
    <title>Document</title>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <div class="container">
        <h1 class="text-center my-5">Actualizar Usuario</h1>
        <form action="../crud/actualizar_usuario.php" method="POST" class="text-center  my-5" id="form_actualizar_usuario">
            <div class="row">
                <div class="col-7 col-sm-8 col-md-8 col-lg-8 col-xl-6 col-xxl-6 mx-auto">
                    <input type="hidden" name="idPersona" id="idPersona" value="<?= $idpersona ?>">
                    <input type="hidden" name="idUsuario "id="idUsuario"  value="<?= $idusuario ?>">
                    <input type="hidden" name="idRol" value="<?= $idrol ?>">
                    <label for="dni" class="form-label d-flex">Dni</label>
                    <input type="text" name="dni" class="form-control dni" value="<?= $dni ?>" maxlength="8">

                    <label for="nombres" class="form-label d-flex">Nombre</label>
                    <input type="text" name="nombre" class="form-control nombres" value="<?= $namenombres ?>" readonly>

                    <label for="apellido_paterno" class="form-label d-flex">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" class="form-control apellido_paterno" value="<?= $namepriapellido ?>" readonly>

                    <label for="apellido_materno" class="form-label d-flex">Apellido Paterno</label>
                    <input type="text" name="apellido_materno" class="form-control apellido_materno" value="<?= $namesegapellido ?>" readonly>

                    <label for="celular" class="form-label d-flex">Celular</label>
                    <input type="text" name="celular" class="form-control celular" value="<?= $celular ?>" pattern="[0-9]{1,9}" maxlength="9" >

                    <label for="correo" class="form-label d-flex">Correo Electronico</label>
                    <input type="email" name="correo" class="form-control correo" value="<?= $correo ?>" >

                    <label for="usuario" class="form-label d-flex">Usuario</label>
                    <input type="text" name="usuario" class="form-control usuario" value="<?= $user ?>" >

                    <label for="rol" class="form-label d-flex">Rol</label>
                    <select name="roles" id="roles" class="form-select">
                        <?php
                        include '../conexion.php';
                        $sql = "SELECT r.* FROM roles r";
                        $resultado = mysqli_query($con, $sql);
                        while ($row = $resultado->fetch_assoc()) {
                            $selected = ($row['id_rol'] == $idrol) ? 'selected' : ''; // Verifica si es el rol actual
                            echo "<option value='" . $row['id_rol'] . "' $selected>" . $row['usuario_rol'] . "</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="actualizar_usuario" class="btn btn-info text-center my-3">Enviar</button>
                    <a href="./lista_usuario.php" class="btn btn-danger text-center">Atras</a>
                </div>
        </form>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <script>
        $(".dni").on('keyup', function() {
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
            $('#form_actualizar_usuario').submit(function(e) {
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
                if (dni === '') {
                    ErrorAlert("Debes ingresar un número de DNI");
                } else if (!expDni.test(dni)) {
                    ErrorAlert("Ingresa un número de DNI válido");
                } else if (celular === '') {
                    ErrorAlert("Debes ingresar un numero de celular");
                } else if (!expCelular.test(celular)) {
                    ErrorAlert("Debes ingresar un numero de celular valido");
                } else if (correo === '') {
                    ErrorAlert("Debes ingresar un correo");
                } else if (!correo.includes('@')) {
                    ErrorAlert("Ingresa un correo con un dominio válido (ejemplo: @gmail, @outlook, @otrodominio)");
                } else if (!expCorreo.test(correo)) {
                    ErrorAlert("Ingresa un correo válido");
                } else if (user === '') {
                    ErrorAlert("Debes crear un nuevo usuario");
                } else if (!expuser.test(user)) {
                    ErrorAlert("El usuario debe tener entre 4 y 20 caracteres alfanuméricos, guiones bajos o guiones");
                } else {
                    Swal.fire({
                        title: "¿Desea actualizar a este usuario?",
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
                            let idusuario = $("#idUsuario").val();
                            let idpersona = $("#idPersona").val();


                            $.ajax({
                                type: 'POST',
                                url: '../crud/actualizar_usuario.php',
                                data: {
                                    dni: dni,
                                    nombres: nombres,
                                    apellido_paterno: apellido_paterno,
                                    apellido_materno: apellido_materno,
                                    celular: celular,
                                    correo: correo,
                                    usuario: user,
                                    idRol: rol,
                                    idUsuario: idusuario,
                                    idPersona: idpersona,

                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Actualizado",
                                            icon: "success",
                                            text: response.mensaje
                                        });
                                    } else {
                                        console.log(response)
                                        Swal.fire({
                                            title: "Error de insercion",
                                            icon: "error",
                                            text: response.mensaje 
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