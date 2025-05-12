<?php
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar Imagen</title>
</head>

<body>
    <h1>Guardar Imagen</h1>
    <form method="POST" enctype="multipart/form-data" id="formulario">
        <input type="file" class="form-control foto" name="imagen">
        <input type="submit" value="Enviar">
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var formulario = document.getElementById("formulario");

            formulario.addEventListener("submit", function (e) {
                e.preventDefault();

                var formData = new FormData(formulario);

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "prueba_img.php", true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log('Todo correcto');
                    } else {
                        console.log('Error: ' + xhr.statusText);
                    }
                };

                xhr.send(formData);
            });
        });
    </script>
</body>

</html>
