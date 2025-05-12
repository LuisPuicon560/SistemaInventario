<?php
include '../conexion.php';
include '../contenido/welcome.php';
$sql = "SELECT id_categoria, nombre_categoria , estado FROM categoria ORDER BY nombre_categoria";
$categoria = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php'; ?>
    <title>Categoria</title>
</head>

<body>
    <?php include '../contenido/menu.php'; ?>
    <h2 class="text-center">Registrar Categoría</h2>
    <div class="container">
        <div class="row my-4">
            <div class="col-4">
                <form action="../crud/agregar_categoria.php" method="POST" class="text-center my-3">
                    <div><?php include '../contenido/mensaje.php'; ?></div>
                    <div class="row">

                        <label for="categoria" class="form-label">Nombre de la categoría:</label>
                        <input type="text" name="categoria" placeholder="Escribe el nombre de la categoría" class="form-control" required>

                        <div>
                            <button type="submit" class="btn btn-warning  mx-auto my-2">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-8 table-responsive">
                <table class="table table-bordered table-striped text-center" id="example">
                    <thead class="text-center">
                        <th>CATEGORÍA</th>
                        <th>ACCIONES</th>
                    </thead>
                    <tbody>
                        <?php
                        // la consulta dada por la bd, sera modificada para generar un clave valor y luego guardar como elemento a un array nuevo, donde es conocida como array asociativo. 
                        while ($row_categoria = $categoria->fetch_assoc()) { ?>
                            <tr>
                                <!-- primera columna -->
                                <td><?= $row_categoria['nombre_categoria']; ?></td>
                                <!--  -->
                                <td>
                                    <!-- data-bs-target: crea un nombre de referencia para el modal 
                                        data-bs-toggle: que tipo de accion quiers tomar de bs5, modal-->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-categoria" data-bs-id="<?= $row_categoria['id_categoria']; ?>">Editar</button>
                                    <?php
                                    if ($row_categoria['estado'] == 1) {
                                        echo "<a href='../crud/estado_categoria.php?id=" . $row_categoria['id_categoria'] . "&estado=0' class='btn btn-danger'>Desactivar</a>";
                                    } else {
                                        echo "<a href='../crud/estado_categoria.php?id=" . $row_categoria['id_categoria'] . "&estado=1' class='btn btn-success'>Activar</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include 'modal/editar_categoria.php'; ?>
        <?php include 'modal/elimina_categoria.php'; ?>
        <script src="./Data_modal/getCategoria.js"></script>
    </div>
    <?php include '../contenido/footer.php'; ?>
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