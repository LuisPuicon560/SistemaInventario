<?php
include '../conexion.php';
include '../contenido/welcome.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../contenido/head.php'; ?>
    <title>Document</title>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <div class="container">
        <div class="row ">
            <form action="../crud/agregar_familia.php" id="form_familia" method="POST" class="text-center my-5">
                <div class="row">
                    <div class="mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-5">
                        <h2 class="text-center my-3">Registrar Serie</h2>
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Marca">
                            Elegir marca
                        </button>
                        <input type="hidden" name="idMarca" class="idMarca">
                        <label for="categoria" class="form-label d-flex my-2">Categoria:</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly>
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria:</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly>
                        <label for="marca" class="form-label d-flex my-2">Marca:</label>
                        <input type="text" class="form-control marca" name="marca" readonly>
                        <label for="familia" class="form-label d-flex my-2">Nombre de la Serie:</label>
                        <input type="text" name="familia" placeholder="Escribe el nombre de la serie" class="form-control nombre_serie" >
                    </div>
                </div>
                <div class="my-1">
                    <button type="submit" class="btn btn-info text-center">Registrar Serie</button>
                    <a href="./lista_familia.php" class="btn btn-danger text-center">Ver la lista</a>
                </div>
            </form>
        </div>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getMarca.php'; ?>
    <script>
        $(document).ready(function() {

            // Manejar el envío del formulario mediante AJAX
            $('#form_familia').submit(function(e) {
                e.preventDefault();
                let idmarca = $(".idMarca").val();
                let nombre_serie = $(".nombre_serie").val();

                if (idmarca === '') {
                    ErrorAlert("Debe elegir una marca");
                } else if (nombre_serie === '') {
                    ErrorAlert("El nombre de la serie no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Quíeres registrar esta serie?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_familia.php',
                                data: {
                                    idmarca: idmarca,
                                    nombre_serie: nombre_serie
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

                                        // Limpiar campos
                                        $(".idMarca").val('');
                                        $(".categoria").val('');
                                        $(".subcategoria").val('');
                                        $(".marca").val('');
                                        $(".nombre_serie").val('');
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
            });

            function ErrorAlert(fallo) {
                Swal.fire({
                    icon: "error",
                    title: fallo,
                });
            }
        });
    </script>
</body>

</html>