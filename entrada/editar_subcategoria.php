<?php
include '../conexion.php';
include '../contenido/welcome.php';
if (empty($_GET['id'])) {
    header('location: lista_subcategoria.php');
}

$id_subcategoria = $_GET['id'];

$getSubcategoria = mysqli_query($con, "SELECT c.*,sc.* from categoria c INNER JOIN subcategoria sc ON c.id_categoria= sc.id_categoria WHERE id_subcategoria = $id_subcategoria");
$resultados = mysqli_num_rows($getSubcategoria);

if ($resultados == 0) {
    $_SESSION['mensaje'] = "No es posible editar";
    header('location: ./lista_subcategoria.php');
} else {
    while ($data = mysqli_fetch_array($getSubcategoria)) {
        $idcategoria = $data['id_categoria'];
        $namecategoria = $data['nombre_categoria'];
        $idsubcategoria = $data['id_subcategoria'];
        $namesubcategoria = $data['nombre_subcategoria'];
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
    <title>Subcategoria</title>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <div class="container">
        <div class="row ">
            <form action="../crud/actualizar_subcategoria.php" id="form_subcategoria" method="POST" class="text-center my-5">
                <div class="row">
                    <div class=" mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-5">
                        <h2 class="text-center my-4">Actualizar Subcategoría</h2>
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Categoria">
                            Elegir categoria
                        </button>
                        <input type="hidden" name="idCategoria" class="idCategoria" value="<?php echo $idcategoria ?>"> <br>
                        <input type="hidden" name="idSubcategoria" class="idSubcategoria" value="<?php echo $idsubcategoria ?>">
                        <label for="categoria" class="form-label d-flex my-2">Categoria</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly value="<?php echo $namecategoria ?>">
                        <label for="subcategoria" class="form-label d-flex my-2">Nombre de la subcategoría:</label>
                        <input type="text" name="subcategoria" placeholder="Escribe el nombre de la subcategoría" class="form-control nombre_subcategoria" value="<?php echo $namesubcategoria ?>">
                    </div>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-info text-center" name="enviar_subcategoria">Actualizar</button>
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
                let idcategoria = $(".idCategoria").val();
                let idsubcategoria = $(".idSubcategoria").val();
                let nombre_subcat = $(".nombre_subcategoria").val();


                if (idcategoria === '') {
                    ErrorAlert("Debe elegir una categoria");
                } else if (nombre_subcat === '') {
                    ErrorAlert("El nombre de la subcategoria no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Quíeres actualizar esta subcategoria?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/actualizar_subcategoria.php',
                                data: {
                                    idcategoria: idcategoria,
                                    nombre_subcat: nombre_subcat,
                                    idsubcategoria: idsubcategoria
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
                                            title: "Error de actualizacion",
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