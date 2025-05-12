<?php
include '../conexion.php';
include '../contenido/welcome.php';

$sql = "SELECT c.id_categoria, c.nombre_categoria, sc.id_subcategoria, sc.nombre_subcategoria, sc.estado
FROM categoria c
INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria WHERE c.estado=1
ORDER BY c.nombre_categoria, sc.nombre_subcategoria";
$subcategoria = mysqli_query($con, $sql);
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
    <h2 class="text-center">Lista de Subcategoría</h2>
    <div class="container">
        <div class="text-center"><?php include '../contenido/mensaje.php'; ?></div>
        <table class="table table-bordered table-striped text-center" id="example">
            <thead>
                <tr>
                    <th>CATEGORÍA</th>
                    <th>SUBCATEGORÍA</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_subcategoria = $subcategoria->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row_subcategoria['nombre_categoria']; ?></td>
                        <td><?= $row_subcategoria['nombre_subcategoria']; ?></td>
                        <td class="text-center">
                            <?php
                            // Verifica si el estado es activado para mostrar el enlace de editar
                            if ($row_subcategoria['estado'] == 1) {
                                echo "<a href='editar_subcategoria.php?id=" . $row_subcategoria['id_subcategoria'] . "' class='btn btn-info mx-3'>Editar</a>";
                            }

                            if ($row_subcategoria['estado'] == 1) {
                                echo "<a href='../crud/estado_subcategoria.php?id=" . $row_subcategoria['id_subcategoria'] . "&estado=0' class='btn btn-danger'>Desactivar</a>";
                            } else {
                                echo "<a href='../crud/estado_subcategoria.php?id=" . $row_subcategoria['id_subcategoria'] . "&estado=1' class='btn btn-success'>Activar</a>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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