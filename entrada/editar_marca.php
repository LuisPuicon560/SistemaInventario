<?php
include '../conexion.php';
include '../contenido/welcome.php';
if (empty($_GET['id'])) {
    header('location: lista_marca.php');
}

$id_marca = $_GET['id'];

$getMarca = mysqli_query($con, "SELECT c.*,sc.*,ma.* from categoria c INNER JOIN subcategoria sc ON c.id_categoria= sc.id_categoria  INNER JOIN marca ma ON sc.id_subcategoria=ma.id_subcategoria WHERE id_marca = $id_marca ");
// mysqli_close($con);
$resultados = mysqli_num_rows($getMarca);

if ($resultados == 0) {
    $_SESSION['mensaje'] = "No es posible editar";
    header('location: ./lista_marca.php');
} else {
    while ($data = mysqli_fetch_array($getMarca)) {
        $namecategoria = $data['nombre_categoria'];
        $idsubcategoria = $data['id_subcategoria'];
        $namesubcategoria = $data['nombre_subcategoria'];
        $idmarca = $data['id_marca'];
        $namemarca = $data['nombre_marca'];
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
        <div class="row ">
            <form action="../crud/actualizar_marca.php" id="form_marca" method="POST" class="text-center my-5">
                <div class="row">
                    <div class="mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-5">
                        <?php include '../contenido/mensaje.php'; ?>
                        <h2 class="text-center my-4">Actualizar marca</h2>
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Subcategoria">
                            Elegir subcategoria
                        </button>
                        <input type="hidden" name="idSubcategoria" class="idSubcategoria" value="<?php echo $idsubcategoria ?>">
                        <input type="hidden" name="idMarca" class="idMarca" value="<?php echo $idmarca ?>">
                        <label for="categoria" class="form-label d-flex my-2">Categoria</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly value="<?= $namecategoria ?>">
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly value="<?= $namesubcategoria ?>">
                        <label for="marca" class="form-label d-flex my-2">Nombre de la marca:</label>
                        <input type="text" name="marca" placeholder="Escribe el nombre de la marca" class="form-control nombre_marca" value="<?= $namemarca ?>">
                    </div>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-info text-center" name="enviar_marca">Actualizar Marca</button>
                    <a type="submit" href="./lista_marca.php" class="btn btn-danger text-center">Volver a la lista</a>
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
                let idmarca = $(".idMarca").val();
                let nombre_marca = $(".nombre_marca").val();


                if (idsubcategoria === '') {
                    ErrorAlert("Debe elegir una subcategoria");
                } else if (nombre_marca === '') {
                    ErrorAlert("El nombre de la marca no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Quíeres actualizar esta marca?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/actualizar_marca.php',
                                data: {
                                    idsubcategoria: idsubcategoria,
                                    nombre_marca: nombre_marca,
                                    idmarca:idmarca
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