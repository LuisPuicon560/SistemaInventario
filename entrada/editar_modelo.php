<?php
include '../conexion.php';
include '../contenido/welcome.php';
if (empty($_GET['id'])) {
    header('location: lista_modelo.php');
}

$id_modelo = $_GET['id'];

$getModelo = mysqli_query($con, "SELECT c.*,sc.*,ma.*,fa.*,mo.* from categoria c INNER JOIN subcategoria sc ON c.id_categoria= sc.id_categoria  INNER JOIN marca ma ON sc.id_subcategoria=ma.id_subcategoria INNER JOIN familia fa ON ma.id_marca=fa.id_marca INNER JOIN modelo mo ON fa.id_familia=mo.id_familia WHERE mo.id_modelo = $id_modelo ");
$resultados = mysqli_num_rows($getModelo);

if ($resultados == 0) {
    $_SESSION['mensaje'] = "No es posible editar";
    header('location: ./lista_modelo.php');
} else {
    while ($data = mysqli_fetch_array($getModelo)) {
        $namecategoria = $data['nombre_categoria'];
        $namesubcategoria = $data['nombre_subcategoria'];
        $namemarca = $data['nombre_marca'];
        $idfamilia = $data['id_familia'];
        $namefamilia = $data['nombre_familia'];
        $idmodelo = $data['id_modelo'];
        $namemodelo = $data['nombre_modelo'];
        $descripcion = $data['descripcion_modelo'];
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
            <form action="../crud/actualizar_modelo.php" id="form_modelo" method="POST" class="text-center my-5">
                <div class="row">
                    <div class="mx-auto col-8 col-sx-8 col-sm-8 col-md-7 col-lg-5 col-xl-5 col-xxl-5 my-3">
                        <h2 class="text-center my-3">Actualizar Modelo</h2>
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Familia">
                            Elegir serie
                        </button>

                        <input type="hidden" name="idFamilia" class="idFamilia" value="<?= $idfamilia ?>">
                        <input type="hidden" name="idModelo" class="idModelo" value="<?= $idmodelo ?>">
                        <label for="categoria" class="form-label d-flex my-2">Categoria:</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly value="<?= $namecategoria ?>">
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria:</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly value="<?= $namesubcategoria ?>">
                        <label for="marca" class="form-label d-flex my-2">Marca:</label>
                        <input type="text" class="form-control marca" name="marca" readonly value="<?= $namemarca ?>">
                        <label for="familia" class="form-label d-flex my-2">Familia:</label>
                        <input type="text" name="familia" placeholder="Escribe el nombre de la familia" class="form-control familia" readonly value="<?= $namefamilia ?>">


                        <label for="modelo" class="form-label mx-2 my-2">Nombre del modelo:</label>
                        <input type="text" name="modelo" class="form-control text-center nombre_modelo" placeholder="Escribe el nombre de describe a la familia" value="<?= $namemodelo ?>">
                        <label for="descripcion" class="form-label my-1">Descripcion de modelo:</label>
                        <textarea name="descripcion" class="form-control descripcion_modelo " cols="30" rows="4"><?= $descripcion ?></textarea>
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-info text-center my-3" name="actualizar_modelo">Actualizar Modelo</button>
                        <a href="./lista_modelo.php" class="btn btn-danger text-center">Volver a la lista</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getFamilia.php'; ?>
    <script>
        $('#form_modelo').submit(function(e) {
            e.preventDefault();
            let idfamilia = $(".idFamilia").val();
            let idmodelo = $(".idModelo").val();
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
                    title: "¿Quíeres actualizar este modelo?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '../crud/actualizar_modelo.php',
                            data: {
                                idfamilia: idfamilia,
                                idmodelo: idmodelo,
                                nombre_modelo: nombre_modelo,
                                descripcion_modelo: descripcion_modelo
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
                                        title: "Error de Actualizacion",
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
    </script>
</body>

</html>