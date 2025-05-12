<?php
include '../conexion.php';
include '../contenido/welcome.php';
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
            <form action="../crud/agregar_producto.php" id="form_producto" method="POST" class="text-center my-5">
                <div class="row">
                    <h2 class="text-center">Registrar Producto</h2>

                    <div class="mx-auto col-10 col-sx-10 col-sm-12 col-md-7 col-lg-6 col-xl-6 col-xxl-7">
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Modelo">
                            Elegir modelo
                        </button>
                        <input type="hidden" name="idModelo" class="idModelo">
                        <label for="categoria" class="form-label d-flex my-2">Categoria:</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly>
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria:</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly>
                        <label for="marca" class="form-label d-flex my-2">Marca:</label>
                        <input type="text" class="form-control marca" name="marca" readonly>
                        <label for="familia" class="form-label d-flex my-2">Serie:</label>
                        <input type="text" name="familia" class="form-control familia" readonly>
                        <label for="modelo" class="form-label d-flex my-2">Nombre del modelo:</label>
                        <input type="text" name="modelo" class="form-control modelo" placeholder="Datos referentes al modelo de dicha familia" readonly>
                        <label for="descripcion" class="form-label d-flex my-1">Descripcion de modelo:</label>
                        <textarea name="descripcion" name="descripcion" class="form-control descripcion " cols="30" rows="3" readonly></textarea>
                        <label for="codigo" class="form-label">Codigo de Referencia</label>
                        <input type="text" name="codigo" class="form-control codigo_referencia" >
                    </div>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-info text-center my-3">Registrar producto</button>
                    <a href="./lista_producto.php" class="btn btn-danger text-center">Ver la lista</a>
                </div>
            </form>
        </div>
        <?php include '../contenido/footer.php'; ?>
        <?php include 'modal/getModelo.php'; ?>
        <script>
            $(document).ready(function() {

                // Manejar el envío del formulario mediante AJAX
                $('#form_producto').submit(function(e) {
                    e.preventDefault();
                    // let expserie = /^[a-zA-Z0-9_-]{4,10}$/;
                    let idmodelo = $(".idModelo").val();
                    let codigo = $(".codigo_referencia").val();


                    if (idmodelo === '') {
                        ErrorAlert("Debe elegir un modelo");
                    } else if (codigo === '') {
                        ErrorAlert("El codigo de referencia no puede estar acio ");
                    } else {

                        Swal.fire({
                            title: "¿Quíeres registrar este producto?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    type: 'POST',
                                    url: '../crud/agregar_producto.php',
                                    data: {
                                        idmodelo: idmodelo,
                                        codigo: codigo
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
                                            $(".idModelo").val('');
                                            $(".categoria").val('');
                                            $(".subcategoria").val('');
                                            $(".marca").val('');
                                            $(".modelo").val('');
                                            $(".descripcion").val('');
                                            $(".codigo_referencia").val('');
                                            $(".familia").val('');

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