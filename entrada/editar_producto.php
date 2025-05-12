<?php
include '../conexion.php';
include '../contenido/welcome.php';
if (empty($_GET['id'])) {
    header('location: lista_producto.php');
}

$id_producto = $_GET['id'];

$getProducto = mysqli_query($con, "SELECT c.*,sc.*,ma.*,fa.*,mo.*,pro.* from categoria c INNER JOIN subcategoria sc ON c.id_categoria= sc.id_categoria  INNER JOIN marca ma ON sc.id_subcategoria=ma.id_subcategoria INNER JOIN familia fa ON ma.id_marca=fa.id_marca INNER JOIN modelo mo ON fa.id_familia=mo.id_familia INNER JOIN producto pro ON mo.id_modelo=pro.id_modelo WHERE pro.id_producto = $id_producto ");
// mysqli_close($con);
$resultados = mysqli_num_rows($getProducto);

if ($resultados == 0) {
    $_SESSION['mensaje'] = "No es posible editar";
    header('location: ./lista_producto.php');
} else {
    while ($data = mysqli_fetch_array($getProducto)) {
        $namecategoria = $data['nombre_categoria'];
        $namesubcategoria = $data['nombre_subcategoria'];
        $namemarca = $data['nombre_marca'];
        $namefamilia = $data['nombre_familia'];
        $idmodelo = $data['id_modelo'];
        $namemodelo = $data['nombre_modelo'];
        $descripcion = $data['descripcion_modelo'];
        $idproducto = $data['id_producto'];
        $nameproducto = $data['codigo_referencia'];
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
            <form action="../crud/actualizar_producto.php" id="form_producto" method="POST" class="text-center my-5">
                <div class="row">
                    <?php include '../contenido/mensaje.php'; ?>
                    <h2 class="text-center my-4">Actualizar Producto</h2>
                    <div class="mx-auto col-5 col-sx-8 col-sm-8 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                        <button type="button" class="form-control" style="background-color:#414bb2; color:white" data-bs-toggle="modal" data-bs-target="#Modelo">
                            Elegir Modelo
                        </button>
                        <input type="hidden" name="idModelo" class="idModelo" value="<?= $idmodelo ?>">
                        <input type="hidden" name="idProducto" class="idProducto" value="<?= $idproducto ?>">
                        <label for="categoria" class="form-label d-flex my-2">Categoria:</label>
                        <input type="text" class="form-control categoria" name="categoria" readonly value="<?= $namecategoria ?>">
                        <label for="subcategoria" class="form-label d-flex my-2">Subcategoria:</label>
                        <input type="text" class="form-control subcategoria" name="subcategoria" readonly value="<?= $namesubcategoria ?>">
                        <label for="marca" class="form-label d-flex my-2">Marca:</label>
                        <input type="text" class="form-control marca" name="marca" readonly value="<?= $namemarca ?>">
                        <label for="familia" class="form-label d-flex my-2">Familia:</label>
                        <input type="text" name="familia" placeholder="Escribe el nombre de la familia" class="form-control familia" readonly value="<?= $namefamilia ?>">
                    </div>
                    <div class="mx-auto col-7 col-sx-8 col-sm-8 col-md-7 col-lg-7 col-xl-7 col-xxl-7" style="margin:38px 0">
                        <label for="modelo" class="form-label mx-2 my-2">Modelo:</label>
                        <input type="text" name="modelo" class="form-control text-center modelo" placeholder="Escribe el nombre de describe a la familia" value="<?= $namemodelo ?>" readonly>
                        <label for="descripcion" class="form-label my-1">Descripcion:</label>
                        <textarea name="descripcion" class="form-control descripcion" cols="30" rows="5" readonly><?= $descripcion ?></textarea>
                        <label for="codigo" class="form-label">Codigo de Referencia</label>
                        <input type="text" name="codigo" class="form-control codigo_referencia" value="<?= $nameproducto ?>">
                    </div>
                </div>
                <div class="my-1">
                    <button type="submit" class="btn btn-info text-center my-3" name="actualizar_producto">Actualizar Producto</button>
                    <a href="./lista_producto.php" class="btn btn-danger text-center">Volver a la lista</a>
                </div>
            </form>
        </div>
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
                let idproducto = $(".idProducto").val();
                let codigo = $(".codigo_referencia").val();


                if (idmodelo === '') {
                    ErrorAlert("Debe elegir un modelo");
                } else if (codigo === '') {
                    ErrorAlert("El codigo de referencia no puede estar vacio ");
                } else {

                    Swal.fire({
                        title: "¿Quíeres actualizar este producto?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'POST',
                                url: '../crud/actualizar_producto.php',
                                data: {
                                    idmodelo: idmodelo,
                                    codigo: codigo,
                                    idproducto: idproducto
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