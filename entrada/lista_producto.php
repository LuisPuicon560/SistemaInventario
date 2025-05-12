<?php
include '../conexion.php';
include '../contenido/welcome.php';

$sql = "SELECT c.id_categoria, c.nombre_categoria, sc.id_subcategoria, sc.nombre_subcategoria,ma.id_marca,ma.nombre_marca,fa.nombre_familia,mo.nombre_modelo,mo.descripcion_modelo,pro.id_producto, pro.codigo_referencia,pro.stock_actual,pro.estado
FROM categoria c
INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
INNER JOIN marca ma ON sc.id_subcategoria = ma.id_subcategoria
INNER JOIN familia fa ON ma.id_marca = fa.id_marca
INNER JOIN modelo mo ON fa.id_familia = mo.id_familia
INNER JOIN producto pro ON mo.id_modelo = pro.id_modelo
WHERE  mo.estado=1 and fa.estado = 1 and ma.estado =1 and sc.estado=1 and c.estado=1
ORDER BY  mo.nombre_modelo, pro.codigo_referencia";
$producto = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
    <title>Document</title>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <h2 class="text-center my-4">Lista de Productos</h2>
    <div class="container">
        <div class="table-responsive">

            <table class="table table-bordered table-striped text-center" id="example">
                <thead>
                    <tr>
                        <th>CATEGORÍA</th>
                        <th>SUBCATEGORÍA</th>
                        <th>MARCA</th>
                        <th>FAMILIA</th>
                        <th>MODELO</th>
                        <th>DESCRIPCION</th>
                        <th>CODIGO DE REFERENCIA</th>
                        <th>STOCK ACTUAL</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_producto = $producto->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row_producto['nombre_categoria']; ?></td>
                            <td><?= $row_producto['nombre_subcategoria']; ?></td>
                            <td><?= $row_producto['nombre_marca']; ?></td>
                            <td><?= $row_producto['nombre_familia']; ?></td>
                            <td><?= $row_producto['nombre_modelo']; ?></td>
                            <td class="text-start"><?= nl2br($row_producto['descripcion_modelo']); ?></td>
                            <td><?= $row_producto['codigo_referencia']; ?></td>
                            <td><?= $row_producto['stock_actual']; ?></td>

                            <td class="text-center">
                                <?php
                                // Verifica si el estado es activado para mostrar el enlace de editar
                                if ($row_producto['estado'] == 1) {
                                    echo "<a href='editar_producto.php?id=" . $row_producto['id_producto'] . "' class='btn btn-info mx-3'>Editar</a>";
                                }

                                if ($row_producto['estado'] == 1) {
                                    echo "<a href='../crud/estado_producto.php?id=" . $row_producto['id_producto'] . "&estado=0' class='btn btn-danger'>Desactivar</a>";
                                } else {
                                    echo "<a href='../crud/estado_producto.php?id=" . $row_producto['id_producto'] . "&estado=1' class='btn btn-success'>Activar</a>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php include '../contenido/footer.php'; ?>
    </div>
    <script type="text/javascript">
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