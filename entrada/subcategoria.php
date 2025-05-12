<?php
include '../conexion.php';
include '../contenido/welcome.php';

$sql = "SELECT c.id_categoria, c.nombre_categoria, sc.id_subcategoria, sc.nombre_subcategoria
FROM categoria c
INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
WHERE sc.estado = 1
ORDER BY c.nombre_categoria, sc.nombre_subcategoria";
$subcategoria = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <div class="container">
        <div class="row ">
            <form action="../crud/agregar_subcategoria.php" id="form_subcategoria" method="POST" class="text-center my-5">
                <div class="row">
                    <div class="mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-5">
                        <h2 class="text-center my-4">Registrar Subcategoría</h2>
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Categoria">
                            Elegir categoria
                        </button>
                        <input type="hidden" name="idCategoria" class="idCategoria">
                        <label for="categoria" class="form-label d-flex my-2 categoria">Categoria</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly>
                        <label for="subcategoria" class="form-label d-flex my-2">Nombre de la subcategoría:</label>
                        <input type="text" name="subcategoria" placeholder="Escribe el nombre de la subcategoría" class="form-control nombre_subcategoria">
                    </div>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-info text-center btn_subcategoria">Enviar</button>
                    <a type="submit" href="./lista_subcategoria.php" class="btn btn-danger text-center">Atras</a>
                </div>
            </form>
        </div>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getCategoria.php'; ?>
    <script>
        $(document).ready(function() {

            // Manejar el envío del formulario mediante AJAX
            $('#form_subcategoria').submit(function(e) {
                e.preventDefault();
                // let expserie = /^[a-zA-Z0-9_-]{4,10}$/;
                let categoria = $(".idCategoria").val();
                let nombre_subcat = $(".nombre_subcategoria").val();


                if (categoria === '') {
                    ErrorAlert("Debe elegir una categoria");
                } else if (nombre_subcat === '') {
                    ErrorAlert("El nombre de la subcategoria no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Quíeres registrar esta subcategoria?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_subcategoria.php',
                                data: {
                                    categoria: categoria,
                                    nombre_subcat: nombre_subcat
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
                                        $(".idCategoria").val('');
                                        $(".categoria").val('');
                                        $(".nombre_subcategoria").val('');
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