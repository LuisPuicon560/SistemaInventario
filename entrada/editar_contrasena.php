<?php
session_start();

// Verificar si la variable de sesión está definida
if (!isset($_SESSION['correo_usuario'])) {
    // Redirigir a la página de verificación si no está definida
    header('Location: ./verificacion.php');
    exit;
}

$correo = $_SESSION['correo_usuario'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
</head>

<body>
    <div class="bg-light d-flex align-items-center justify-content-center vh-100">
        <div class="container col-4">
            <form id="form_contrasena" class="p-4 bg-white rounded">
                <h1 class="text-center my-4">Actualizar Contraseña</h1>
                <label form="contrasena" class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control contrasena">
                <input type="hidden" class="correo" value="<?= $correo ?>">
                <div class="text-center">
                    <input type="submit" value="enviar" class="btn btn-primary mt-3">
                </div>
            </form>
        </div>
    </div>

    <?php include '../contenido/footer.php'; ?>
    <script>
        $(document).ready(function() {
            function ErrorAlert(message) {
                Swal.fire({
                    title: "Error",
                    text: message,
                    icon: "error",
                    toast: true,
                    position: 'top-end', // Puedes ajustar la posición según tus preferencias
                    showConfirmButton: false,
                    timer: 3000 // Duración en milisegundos
                });
            }
            $("#form_contrasena").submit(function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe por el método tradicional

                let expass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
                let pass = $('.contrasena').val();
                let correo = $('.correo').val();

                if (pass === '') {
                    ErrorAlert("Debes ingresar la nueva contraseña");
                } else if (!expass.test(pass)) {
                    ErrorAlert("La contraseña debe tener al menos 8 caracteres, con al menos una letra y un número");
                } else {
                    Swal.fire({
                        title: "¿Estás seguro que quieres actualizar esta contraseña?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "../crud/actualizar_contrasena.php",
                                data: {
                                    pass: pass,
                                    correo: correo
                                },
                                dataType: "json",
                                success: function(response) {
                                    // Manejar la respuesta si es exitosa
                                    console.log(response);
                                    window.location.href = '../index.php';
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    Swal.fire({
                                        title: "No se pudo actualizar la contraseña!",
                                        text: "Ocurrió un error al procesar la solicitud.",
                                        icon: "error",
                                        toast: true,
                                        position: 'top-end', // Puedes ajustar la posición según tus preferencias
                                        showConfirmButton: false,
                                        timer: 3000 // Duración en milisegundos
                                    });
                                }
                            });

                        }
                    });
                }
            });
        });
    </script>
</body>

</html>