<?php
include '../conexion.php';
include '../contenido/welcome.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../contenido/head.php'); ?>
    <title>Document</title>
</head>

<body>
    <?php include('../contenido/menu.php'); ?>
    <h1 class="text-center my-5">Lista de usuarios</h1>
    <div class="container my-5">
        <?php include('../contenido/mensaje.php'); ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="table_usuario">
        <thead>
            <th>DNI</th>
            <th>nombres y apellidos</th>
            <th>correo</th>
            <th>telefono</th>
            <th>usuario </th>
            <th>Rol</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php
            include '../conexion.php';
            $sql = "SELECT p.*,u.*,r.* FROM usuario u INNER JOIN persona p ON p.id_persona = u.id_persona INNER JOIN roles r ON r.id_rol = u.id_rol";
            $resultado = mysqli_query($con, $sql);
            while ($mostrar = mysqli_fetch_array($resultado)) {
            ?>
                <tr>
                    <td><?php echo $mostrar['dni_usuario']?> </td>
                    <td><?php echo $mostrar['nombres'] . ' ' . $mostrar['priapellido_persona'] ?> </td>
                    <td><?php echo $mostrar['correo_usuario'] ?></td>
                    <td><?php echo $mostrar['celular_persona'] ?></td>
                    <td><?php echo $mostrar['user_usuario'] ?></td>
                    <td><?php echo $mostrar['usuario_rol'] ?></td>
                    <td class="text-center">
                        <?php
                        // Verifica si el estado es activado para mostrar el enlace de editar
                        if ($mostrar['estado'] == 1) {
                            echo "<a href='editar_usuario.php?id=" . $mostrar['id_usuario'] . "' class='btn btn-info mx-3'>Editar</a>";
                        }

                        if ($mostrar['estado'] == 1) {
                            echo "<a href='../crud/estado_usuario.php?id=" . $mostrar['id_usuario'] . "&estado=0' class='btn btn-danger'>Desactivar</a>";
                        } else {
                            echo "<a href='../crud/estado_usuario.php?id=" . $mostrar['id_usuario'] . "&estado=1' class='btn btn-success'>Activar</a>";
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
    </div>
    <?php include('../contenido/footer.php'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#table_usuario").DataTable({
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