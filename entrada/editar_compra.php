<?php
include '../conexion.php';
include '../contenido/welcome.php';
if (empty($_GET['id'])) {
    header('location: lista_compra.php');
}

$detalle_compra = $_GET['id'];

$getCompra = mysqli_query($con, "SELECT e.id_entidad,e.razon_comercial,e.razon_social,p.priapellido_persona, e.n_documentacion,e.direccion,e.departamento,c.id_compra,c.serie,c.numero , c.fecha_registro, c.igv,c.tipo_moneda,c.total_soles,c.total_dolares,c.valor_moneda, c.estado, pr.id_producto, pr.codigo_referencia, dc.id_detc, dc.cantidad_detc, dc.precio_detc, dc.subtotal_fila FROM entidad e 
INNER JOIN persona p ON e.id_persona= p.id_persona 
INNER JOIN compra c ON c.id_persona = p.id_persona
INNER JOIN detalle_compra dc ON c.id_compra = dc.id_compra
INNER JOIN producto pr ON dc.id_producto = pr.id_producto
WHERE dc.id_compra = $detalle_compra ");
$resultados = mysqli_num_rows($getCompra);

if ($resultados == 0) {
    $_SESSION['mensaje'] = "No es posible editar";
    header('location: ./lista_compra.php');
} else {
    while ($data = mysqli_fetch_array($getCompra)) {

        // id_principales
        $id_proveedor = $data['id_entidad'];
        $id_compra = $data['id_compra'];
        $id_detallecompra = $data['id_detc'];

        // proveedor
        $ruc = $data['n_documentacion'];
        $entidad = $data['razon_social'];
        $comercial = $data['razon_comercial'];
        $direccion = $data['direccion'];
        $departamento = $data['departamento'];
        $tipo_moneda = $data['tipo_moneda'];
        $valor_moneda = $data['valor_moneda'];


        // factura
        $serie = $data['serie'];
        $numero = $data['numero'];
        $fecha = $data['fecha_registro'];

        $productos[] = array(
            // 'id_detalle_c' => $data['id_detc'],
            'id_producto' => $data['id_producto'],
            'codigo_referencia' => $data['codigo_referencia'],
            'cantidad' => $data['cantidad_detc'],
            'precio' => $data['precio_detc'],
            'subtotal_fila' => $data['subtotal_fila'],
            'igv' => $data['igv'],
            'total_dolares' => $data['total_dolares'],
            'total_soles' => $data['total_soles'],
        );
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
        <h2 class="text-center">Actualizar Compra</h2>
        <?php include '../contenido/mensaje.php'; ?>
        <form action="../crud/actualizar_compra.php" method="POST" id="formularioCompra">

            <!-- debe ser una array porque dentro de detalle_compra , existe mas de 1 id_compra -->
            <input type="hidden" name="idcompra" class="idcompra" value="<?= $id_compra ?>">

            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#Proveedor">
                Elegir proveedor
            </button>
            <input type="hidden" name="idproveedor" id="idproveedor" class="proveedor" value="<?= $id_proveedor ?>">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-xl-2">
                    <div class="form-group">
                        <label for="ruc" class="form-label">RUC:</label>
                        <input type="number" name="ruc" id="ruc" class="form-control ruc" disabled value="<?= $ruc ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-9 col-xl-5">
                    <div class="form-group">
                        <label for="representante" class="form-label">Señor(a):</label>
                        <input type="text" name="representante" id="representante" class="form-control representante" disabled value="<?= $entidad ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-xl-5">
                    <div class="form-group ">
                        <label for="nombre_comercial" class="form-label">Nombre comercial:</label>
                        <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control nombre_comercial" disabled value="<?= $comercial ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-sm-12 col-md-9">
                    <label for="direccion" class="form-label">Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control direccion" disabled value="<?= $direccion ?>">
                </div>
                <div class="form-group col-12 col-sm-12 col-md-3">
                    <label for="departamento" class="form-label">Departamento:</label>
                    <input type="text" name="departamento" id="departamento" class="form-control departamento" disabled value="<?= $departamento ?>">
                </div>
            </div>
            <div class="row  my-2">
                <h3 class="text-center">Factura</h3>
                <div class="col-12 col-sm-12 col-md-4">
                    <label for="serie">Serie:</label>
                    <input type="text" id="serie" name="serie" class="form-control serie" value="<?= $serie ?>">
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" class="form-control numero" value="<?= $numero ?>">
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control fecha" value="<?= $fecha ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 my-3">
                    <button type="button" class="btn btn-primary form-control btn_producto" data-bs-toggle="modal" data-bs-target="#Producto">
                        Elegir producto
                    </button>
                </div>
                <div class="col-12 col-sm-12 d-flex align-items-center justify-content-end col-md-8 my-3">
                    <label for="cambio" class="mx-3 cambio">TIPO DE CAMBIO</label>
                    <select class="tipoCambio">
                        <option value="dolar" <?= ($tipo_moneda === 'dolar') ? 'selected' : '' ?>>$/.</option>
                        <option value="soles" <?= ($tipo_moneda === 'soles') ? 'selected' : '' ?>>S/.</option>
                    </select>
                    <input type="text" class="mx-3 respuesta_moneda" readonly value="<?= $valor_moneda ?>">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped " id="tabla_producto">
                    <thead>
                        <tr class="text-center">
                            <th>Item</th>
                            <th>codigo de producto</th>
                            <th>cantidad</th>
                            <th>precio</th>
                            <th>subtotal</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        <?php
                        $n_filas = 0;
                        $total_subtotal = 0;
                        foreach ($productos as $producto) { ?>
                            <tr class='fila-fija text-center'>
    
                                <td style='display:none' class='id_producto'><?= $producto['id_producto'] ?></td>
                                <td><?= ++$n_filas ?></td>
                                <td><?= $producto['codigo_referencia'] ?></td>
                                <td><input type="number" class="form-control cantidad" value="<?= $producto['cantidad'] ?>" name="cantidad"></td>
                                <td><input type="text" class="form-control precio" value="<?= $producto['precio'] ?>" name="precio"></td>
                                <td>
                                    <div class="subtotal_fila"><?= $producto['subtotal_fila'] ?></div>
                                </td>
                                <td><button class="btn btn-danger eliminar_fila">Eliminar</button></td>
                            </tr>
    
                        <?php
                            $total_subtotal += $producto['subtotal_fila'];
                        } ?>
    
                        <?php if ($tipo_moneda === 'soles') { ?>
                            <tr id='subtotal_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>Subtotal(S/.):</td>
                                <td class='subtotal'><?= $total_subtotal ?></td>
                            </tr>
    
                            <tr id='igv_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>IGV(18%)(S/.):</td>
                                <td class='igv'><?= $producto['igv'] ?></td>
                            </tr>
    
                            <tr id='total_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>Total(S/.):</td>
                                <td class='soles_total'><?= $producto['total_soles'] ?></td>
                            </tr>
                            <tr id='dolar_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>Total($/.):</td>
                                <td class='dolar_total'><?= $producto['total_dolares'] ?></td>
                            </tr>
    
                        <?php } else if ($tipo_moneda === 'dolar') { ?>
                            <tr id='subtotal_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>Subtotal($/.):</td>
                                <td class='subtotal'><?= $total_subtotal ?></td>
                            </tr>
    
                            <tr id='igv_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>IGV(18%)($/.):</td>
                                <td class='igv'><?= $producto['igv'] ?></td>
                            </tr>
    
                            <tr id='total_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>Total($/.):</td>
                                <td class='dolar_total'><?= $producto['total_dolares'] ?></td>
                            </tr>
                            <tr id='soles_acumulado_row' class='text-center total-row'>
                                <td colspan='3'></td>
                                <td>Total(S/.):</td>
                                <td class='soles_total'><?= $producto['total_soles'] ?></td>
                            </tr>
                        <?php } else {
                            echo 'error';
                        } ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-dark form-control" id="btnEnviar" name="btnEnviar">Actualizar compra</button>
            <a href="./lista_compra.php" class="btn btn-danger my-2 form-control">Volver a la lista</a>

        </form>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getProveedor.php'; ?>
    <?php include 'modal/getProducto.php'; ?>
    <script>
        $("#fecha").on('change', function() {
            let fechaActual = $(this).val();
            $.ajax({
                type: "POST",
                url: "../crud/api_tipo_cambio.php",
                data: {
                    fecha: fechaActual
                },
                dataType: "json",
                success: function(response) {
                    if (response && response.precioVenta) {
                        // Asigna el valor al campo de respuesta_moneda
                        $(".respuesta_moneda").val(response.precioVenta);
                        actualizarTotalAcumulado();
                    } else {
                        console.error("La respuesta de la API no contiene la información esperada.");
                    }
                }
            });
        });

        $(document).ready(function() {
            // Manejar el envío del formulario mediante AJAX
            $('#formularioCompra').submit(function(e) {
                e.preventDefault();
                let expserie = /^[a-zA-Z0-9°_-]{4,10}$/;

                if ($(".proveedor").val() === '') {
                    ErrorAlert("Falta elegir un proveedor");
                } else if ($(".serie").val() === '') {
                    ErrorAlert("Falta agregar una serie");
                } else if (!expserie.test($(".serie").val())) {
                    ErrorAlert("La serie debe ser al menos 4 letras o numeros");
                } else if ($(".numero").val() === '') {
                    ErrorAlert("Falta agregar una numero");
                } else if ($(".fecha").val() === '') {
                    ErrorAlert("Falta agregar una fecha");
                } else if ($(".respuesta_moneda").val() === '') {
                    ErrorAlert("Debe elegir una fecha entre el actual y fechas anteriores");
                } else if ($(".id_producto").text() === '') {
                    ErrorAlert("Debe agregar al menos un producto");
                } else {

                    Swal.fire({
                        title: "¿Estás seguro de actualizar estos datos?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Actualizar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id_proveedor = $(this).find('.proveedor').val();
                            var id_compra = $(this).find('.idcompra').val();


                            var serie = $(this).find('.serie').val();
                            var numero = $(this).find('.numero').val();
                            var fecha = $(this).find('.fecha').val();
                            var tipo_moneda = $(this).find(".tipoCambio").val();
                            var valor_moneda = $(this).find(".respuesta_moneda").val();

                            var filas = [];
                            $('#tabla_producto tbody tr.fila-fija').each(function() {
                                var id_producto = $(this).find('td:eq(0)').text();
                                var cantidad = $(this).find('.cantidad').val();
                                var precio = $(this).find('.precio').val();
                                var subtotal_fila = $(this).find('.subtotal_fila').text();
                                filas.push({
                                    id_producto: id_producto,
                                    cantidad: cantidad,
                                    precio: precio,
                                    subtotal_fila: subtotal_fila
                                });
                            });

                            var subtotal = $(this).find('.subtotal').text();
                            var igv = $(this).find('.igv').text();
                            var total_soles = $(this).find('.soles_total').text();
                            var total_dolar = $(this).find('.dolar_total').text();

                            $.ajax({
                                type: 'POST',
                                url: '../crud/actualizar_compra.php',
                                data: {
                                    id_compra: id_compra,
                                    // es para entidad
                                    id_proveedor: id_proveedor,
                                    serie: serie,
                                    numero: numero,
                                    fecha: fecha,
                                    tipo_moneda: tipo_moneda,
                                    valor_moneda: valor_moneda,
                                    filas: filas,
                                    subtotal: subtotal,
                                    igv: igv,
                                    total_soles: total_soles,
                                    total_dolar: total_dolar

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
                                    } else {
                                        console.log(response)
                                        Swal.fire({
                                            title: "Error de actualizacion",
                                            icon: "error",
                                            text: response.mensaje
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