<?php
include '../conexion.php';
include '../contenido/welcome.php';

$sql = "SELECT DISTINCT dc.id_compra,e.razon_comercial, e.n_documentacion,e.departamento,c.serie,c.numero ,c.fecha_registro,c.tipo_moneda,c.total_soles,c.total_dolares,c.valor_moneda, c.estado FROM entidad e 
INNER JOIN persona p ON e.id_persona= p.id_persona 
INNER JOIN compra c ON c.id_persona = p.id_persona
INNER JOIN detalle_compra dc ON c.id_compra = dc.id_compra";
$compra = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <h2 class="text-center">Lista de Orden de Compra</h2>
    <div class="container">
        <!-- <div class="text-center"><?php include '../contenido/mensaje.php'; ?></div> -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" id="example">
                <thead>
                    <tr>
                        <th>PROVEEDOR</th>
                        <th>NOMBRE COMERCIAL</th>
                        <th>DEPARTAMENTO</th>
                        <th>FACTURA</th>
                        <th>TOTAL EN SOLES(S/.)</th>
                        <th>TOTAL EN DOLARES($/.)</th>
                        <th>FECHA DE REGISTRO</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_compra = $compra->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row_compra['n_documentacion']; ?></td>
                            <td><?= $row_compra['razon_comercial']; ?></td>
                            <td><?= $row_compra['departamento']; ?></td>
                            <td><?= $row_compra['serie'] . '-' . $row_compra['numero']; ?></td>
                            <td>S/.<?= $row_compra['total_soles']; ?></td>
                            <td>$/.<?= $row_compra['total_dolares']; ?></td>
                            <td><?= $row_compra['fecha_registro']; ?></td>

                            <td class="text-center">
                                <?php
                                // Verifica si el estado es activado para mostrar el enlace de editar
                                if ($row_compra['estado'] == 1) {
                                    echo "<a href='editar_compra.php?id=" . $row_compra['id_compra'] . "' class='btn btn-info mx-3'>Editar</a>";
                                    echo "<a href='#' onclick='mostrarAlerta(" . $row_compra['id_compra'] . ")' class='btn btn-warning mx-3 anular'>Anular</a>";
                                }
                                if ($row_compra['estado'] == 0) {
                                    echo "<div class='btn btn-danger mx-3'>Anulado</div>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-6 my-5">
                <h3 class="text-start my-3">Suma total de todos los no anulados</h3>
                <?php
                $query = mysqli_query($con, "SELECT sum(total_soles) as count_soles, sum(total_dolares) as count_dolares FROM compra where estado =1");
                $result = mysqli_fetch_assoc($query);

                // Accede a los valores de recuento
                $count_soles = $result['count_soles'];
                $count_dolares = $result['count_dolares'];

                // Haz lo que necesites con los valores obtenidos
                echo "<h3>Total en soles(S/.):" . $count_soles . " soles</h3>";
                echo "<h3>Total en dolares($/.):" . $count_dolares . " dolares</h3>";

                ?>
            </div>
            <div class="col-6 my-5">
            <h3 class="text-start my-3">Suma total de todos los anulados</h3>
                <?php
                $query = mysqli_query($con, "SELECT sum(total_soles) as count_soles, sum(total_dolares) as count_dolares FROM compra where estado =0");
                $result = mysqli_fetch_assoc($query);

                // Accede a los valores de recuento
                $count_soles = $result['count_soles'];
                $count_dolares = $result['count_dolares'];

                // Haz lo que necesites con los valores obtenidos
                echo "<h3>Total en soles(S/.):" . $count_soles . " soles</h3>";
                echo "<h3>Total en dolares($/.):" . $count_dolares . " dolares</h3>";

                ?>
            </div>
        </div>
        <?php include '../contenido/footer.php'; ?>
    </div>

    <script>
        function mostrarAlerta(idCompra) {
            Swal.fire({
                title: '¿Estás seguro de anular la compra?',
                text: 'Una vez anulado, no podra habilitarlo otra vez',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, anular',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige al enlace de anulación
                    window.location.href = '../crud/estado_compra.php?id=' + idCompra + '&estado=0';
                }
            });
        }
        $(document).ready(function() {

            $("#example").DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados de la busqueda",
                    "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ultimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior",
                    },
                    "sProcessing": "Procesando..",
                }
            });
        });
    </script>
</body>

</html>