<?php
require_once '../conexion.php';
require_once '../contenido/welcome.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php' ?>
</head>

<body>
    <?php include '../contenido/menu.php' ?>
    <h2 class="text-center my-3">Registrar Compra</h2>
    <div class="container">
        <?php
        $respuesta = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
        unset($_SESSION['mensaje']);
        ?>
        <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#Proveedor">
            Elegir proveedor
        </button>
        <form action="../crud/agregar_compra.php" method="POST" id="formularioCompra">
            <input type="hidden" name="idproveedor" id="idproveedor" class="proveedor">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-xl-2">
                    <div class="form-group">
                        <label for="ruc" class="form-label">RUC:</label>
                        <input type="number" name="ruc" id="ruc" class="form-control ruc" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-9 col-xl-5">
                    <div class="form-group ">
                        <label for="nombre_comercial" class="form-label">Nombre comercial:</label>
                        <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control nombre_comercial" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-xl-5">
                    <div class="form-group">
                        <label for="representante" class="form-label">Razon social:</label>
                        <input type="text" name="representante" id="representante" class="form-control representante" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 col-sm-12 col-md-9">
                    <label for="direccion" class="form-label">Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control direccion" disabled>
                </div>
                <div class="form-group col-12 col-sm-12 col-md-3">
                    <label for="departamento" class="form-label">Departamento:</label>
                    <input type="text" name="departamento" id="departamento" class="form-control departamento" disabled>
                </div>
            </div>
            <div class="row my-2">
                <h3 class="text-center">Factura</h3>
                <div class="col-12 col-sm-12 col-md-4">
                    <label for="serie">Serie:</label>
                    <input type="text" id="serie" name="serie" class="form-control serie">
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" class="form-control numero">
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control fecha">
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
                        <option value="dolar">$/.</option>
                        <option value="soles">S/.</option>
                    </select>
                    <input type="text" class="mx-3 respuesta_moneda" readonly>
                </div>
            </div>
            <!-- agregeu esto recientemente : div class table-responsive -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped " id="tabla_producto">
                    <thead>
                        <tr class="text-center">
                            <th>Item</th>
                            <!-- <th>Figura</th> -->
                            <th>codigo de producto</th>
                            <th>cantidad</th>
                            <th>precio</th>
                            <th>subtotal</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-dark form-control" id="btnEnviar" name="btnEnviar">Registrar Compra</button>
        </form>
        <a class="btn btn-info my-3 d-flex justify-content-center" href="../entrada/lista_compra.php">Ver lista </a>
    </div>
    <?php include '../contenido/footer.php'; ?>
    <?php include 'modal/getProveedor.php'; ?>
    <?php include 'modal/getProducto.php'; ?>
    </div>
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
                        $(".respuesta_moneda").val(response.precioVenta);
                        actualizarTotalAcumulado();
                    } else {
                        console.error("La respuesta de la API no contiene la información esperada.");
                        $(".respuesta_moneda").val('');

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
                    ErrorAlert("Debe elegir un proveedor");
                } else if ($(".serie").val() === '') {
                    ErrorAlert("Es necesario agregar una serie");
                } else if (!expserie.test($(".serie").val())) {
                    ErrorAlert("La serie debe ser al menos 4 letras o numeros como tambien no incluir espacios en blanco");
                } else if ($(".numero").val() === '') {
                    ErrorAlert("Es necesario agregar un numero");
                } else if ($(".fecha").val() === '') {
                    ErrorAlert("Se necesita agregar una fecha");
                } else if ($(".respuesta_moneda").val() === '') {
                    ErrorAlert("Debe elegir una fecha entre el actual y fechas anteriores");
                } else if ($(".id_producto").text() === '') {
                    ErrorAlert("Debe agregar al menos un producto");
                } else {

                    Swal.fire({
                        title: "¿Quíeres registrar esta compra?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id_proveedor = $(this).find('.proveedor').val();
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
                                    subtotal_fila: subtotal_fila,
                                });
                            });

                            var subtotal = $(this).find('.subtotal').text();
                            var igv = $(this).find('.igv').text();
                            var total_soles = $(this).find('.soles_total').text();
                            var total_dolar = $(this).find('.dolar_total').text();


                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_compra.php',
                                data: {
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
                                        $('.proveedor').val('');
                                        $('.ruc').val('');
                                        $('.representante').val('');
                                        $('.nombre_comercial').val('');
                                        $('.direccion').val('');
                                        $('.departamento').val('');
                                        $('.serie').val('');
                                        $('.numero').val('');
                                        $('.fecha').val('');
                                        $('.respuesta_moneda').val('');
                                        $('#tabla_producto tbody').html('');


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