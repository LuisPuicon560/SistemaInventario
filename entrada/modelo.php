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
            <form action="../crud/agregar_modelo.php" id="form_modelo" method="POST" enctype="multipart/form-data" class="text-center my-5">
                <div class="row">
                    <h2 class="text-center my-2">Registrar Modelo</h2>
                    <div class="mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-2">
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Familia">
                            Elegir Serie
                        </button>
                        <input type="hidden" name="idFamilia" class="idFamilia">
                        <label for="categoria" class="form-label d-flex my-2">Categoria:</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly>
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria:</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly>
                        <label for="marca" class="form-label d-flex my-2">Marca:</label>
                        <input type="text" class="form-control marca" name="marca" readonly>
                        <label for="familia" class="form-label d-flex my-2">Serie:</label>
                        <input type="text" name="familia" class="form-control familia" readonly>
                        <label for="modelo" class="form-label mx-2 my-2">Nombre del modelo:</label>
                        <input type="text" name="modelo" class="form-control text-center nombre_modelo">
                        <label for="descripcion" class="form-label my-1">Descripcion general del modelo:</label>
                        <textarea name="descripcion" name="descripcion" class="form-control descripcion_modelo" cols="30" rows="2"></textarea>
                    </div>
                </div>
                <div class="my-1">
                    <button type="submit" class="btn btn-info text-center my-3">Registrar Modelo</button>
                    <a href="./lista_modelo.php" class="btn btn-danger text-center">Ver la lista</a>
                </div>
            </form>
        </div>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getFamilia.php'; ?>
    <script>
        $(document).ready(function() {

            // Manejar el envío del formulario mediante AJAX
            $('#form_modelo').submit(function(e) {
                e.preventDefault();
                let idfamilia = $(".idFamilia").val();
                let nombre_modelo = $(".nombre_modelo").val();
                let descripcion_modelo = $(".descripcion_modelo").val();

                if (idfamilia === '') {
                    ErrorAlert("Debe elegir una serie");
                } else if (nombre_modelo === '') {
                    ErrorAlert("El nombre del modelo no puede estar vacia");
                } else if (descripcion_modelo === '') {
                    ErrorAlert("La descripcion general del modelo no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Quíeres registrar este modelo?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_modelo.php',
                                data: {
                                    idfamilia: idfamilia,
                                    nombre_modelo: nombre_modelo,
                                    descripcion_modelo: descripcion_modelo
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
                                        $(".idFamilia").val('');
                                        $(".categoria").val('');
                                        $(".subcategoria").val('');
                                        $(".marca").val('');
                                        $(".familia").val('');
                                        $(".nombre_modelo").val('');
                                        $(".descripcion_modelo").val('');
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