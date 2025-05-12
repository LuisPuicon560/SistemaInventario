<?php
include '../conexion.php';
include '../contenido/welcome.php';

$sql = "SELECT c.id_categoria, c.nombre_categoria, sc.id_subcategoria, sc.nombre_subcategoria,ma.id_marca,ma.nombre_marca,fa.id_familia,fa.nombre_familia,fa.estado
FROM categoria c
INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
INNER JOIN marca ma ON sc.id_subcategoria = ma.id_subcategoria
INNER JOIN familia fa ON ma.id_marca = fa.id_marca
WHERE ma.estado =1 and sc.estado=1 and c.estado=1
ORDER BY  ma.nombre_marca, fa.nombre_familia";
$marca = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../contenido/head.php'; ?>
    <title>Document</title>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <h2 class="text-center">Lista de Familias o series</h2>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" id="example">
                <thead>
                    <tr>
                        <th>CATEGORÍA</th>
                        <th>SUBCATEGORÍA</th>
                        <th>MARCA</th>
                        <th>FAMILIA</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_marca = $marca->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row_marca['nombre_categoria']; ?></td>
                            <td><?= $row_marca['nombre_subcategoria']; ?></td>
                            <td><?= $row_marca['nombre_marca']; ?></td>
                            <td><?= $row_marca['nombre_familia']; ?></td>
                            <td class="text-center">
                                <?php
                                // Verifica si el estado es activado para mostrar el enlace de editar
                                if ($row_marca['estado'] == 1) {
                                    echo "<a href='editar_familia.php?id=" . $row_marca['id_familia'] . "' class='btn btn-info mx-3'>Editar</a>";
                                }

                                if ($row_marca['estado'] == 1) {
                                    echo "<a href='../crud/estado_familia.php?id=" . $row_marca['id_familia'] . "&estado=0' class='btn btn-danger'>Desactivar</a>";
                                } else {
                                    echo "<a href='../crud/estado_familia.php?id=" . $row_marca['id_familia'] . "&estado=1' class='btn btn-success'>Activar</a>";
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

    <script>
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