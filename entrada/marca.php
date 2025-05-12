<?php
include_once '../conexion.php';
include_once '../contenido/welcome.php';

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
        <div class="row ">
            <form action="../crud/agregar_marca.php" id="form_marca" method="POST" class="text-center my-5">
                <div class="row">
                    <div class="mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-5">
                        <div class="text-center"><?php include '../contenido/mensaje.php'; ?></div>
                        <h2 class="text-center my-4">Registrar Marca</h2>
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Subcategoria">
                            Elegir subcategoria
                        </button>
                        <input type="hidden" name="idSubcategoria" class="idSubcategoria">
                        <label for="categoria" class="form-label d-flex my-2">Categoria</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly>
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly>
                        <label for="marca" class="form-label d-flex my-2">Nombre de la marca:</label>
                        <input type="text" name="marca" placeholder="Escribe el nombre de la marca" class="form-control nombre_marca">
                    </div>
                </div>
                <div class="my-2">
                    <button type="submit" class="btn btn-info text-center">Registrar Marca</button>
                    <a href="./lista_marca.php" class="btn btn-danger text-center">Ver lista</a>
                </div>
            </form>
        </div>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getSubcategoria.php'; ?>
    <script>
        $(document).ready(function() {

            // Manejar el envío del formulario mediante AJAX
            $('#form_marca').submit(function(e) {
                e.preventDefault();
                // let expserie = /^[a-zA-Z0-9_-]{4,10}$/;
                let idsubcategoria = $(".idSubcategoria").val();
                let nombre_marca = $(".nombre_marca").val();


                if (idsubcategoria === '') {
                    ErrorAlert("Debe elegir una subcategoria");
                } else if (nombre_marca === '') {
                    ErrorAlert("El nombre de la marca no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Quíeres registrar esta marca?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_marca.php',
                                data: {
                                    idsubcategoria: idsubcategoria,
                                    nombre_marca: nombre_marca
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
                                        $(".idSubcategoria").val('');
                                        $(".categoria").val('');
                                        $(".subcategoria").val('');
                                        $(".nombre_marca").val('');
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