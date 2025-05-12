<?php
include '../conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $verificar = mysqli_query($con, "SELECT correo_usuario FROM usuario WHERE correo_usuario = '$correo'");

    if (mysqli_num_rows($verificar) > 0) {
        $_SESSION['correo_usuario'] = $correo;
        echo json_encode(['status' => 'success']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Correo no registrado']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">                      

<head>
    <meta charset="UTF-8">
    <?php include '../contenido/head.php' ?>
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="container-fluid h-100 d-flex flex-column justify-content-center align-items-center">
        <form id="correoForm" class="p-4 bg-white rounded col-12 col-sm-8 col-md-6 col-lg-4">
            <h1 class="my-5 col-12 text-center">Recuperacion de correo electrónico</h1>
            <label for="correo" class="form-label">Escribe tu correo electrónico</label>
            <input type="text" class="form-control correo" name="correo" id="correo">
            <div class="text-center">
                <input type="button" value="enviar" onclick="verificarCorreo()" class="btn btn-primary mt-3">
            </div>
        </form>
    </div>
    <?php include '../contenido/footer.php' ?>
    <script>
        function ErrorAlert(message) {
            Swal.fire({
                title: "Error",
                text: message,
                icon: "error",

                toast: true,
                position: 'top-end', // Puedes ajustar la posición según tus preferencias
                showConfirmButton: false,
                timer: 3000
            });
        }

        function verificarCorreo() {
            let correo = $("#correo").val();
            if (correo === '') {
                ErrorAlert("Debes ingresar el correo para verificarse");
            } else {
                $.ajax({
                    type: "POST",
                    url: "./verificacion.php",
                    data: {
                        correo: correo
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = "./editar_contrasena.php";
                        } else {
                            Swal.fire({
                                title: "Correo no registrado!",
                                text: "Este correo no existe",
                                icon: "error",
                                toast: true,
                                position: 'top-end', // Puedes ajustar la posición según tus preferencias
                                showConfirmButton: false,
                                timer: 3000 // Duración en milisegundos
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Error de conexión!",
                            text: "Hubo un problema al verificar el correo",
                            icon: "error",
                            // Agrega la opción 'toast' para evitar que suba el formulario
                            toast: true,
                            position: 'top-end', // Puedes ajustar la posición según tus preferencias
                            showConfirmButton: false,
                            timer: 3000 // Duración en milisegundos
                        });
                    }
                });
            }
        }
    </script>
</body>

</html>