<div class="modal fade" id="Proveedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Usa la clase modal-xl para un ancho extra grande -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped text-center" id="datos_proveedor">
                    <thead>
                        <tr>
                            <th>AGREGAR</th>
                            <th>Ruc</th>
                            <th>Proveedor</th>
                            <th>Razon social</th>
                            <th>Direccion</th>
                            <th>Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($con, "SELECT e.n_documentacion, e.razon_social,e.razon_comercial, e.id_entidad ,e.direccion, e.departamento
                        FROM persona p
                        INNER JOIN entidad e ON p.id_persona = e.id_persona
                        WHERE e.estado = 1 AND e.subtipo_entidad ='proveedor'");
                        while ($row_proveedor = $sql->fetch_assoc()) { ?>
                            <tr>
                                <td><button type="button" class="btn btn-primary btn-sm agregar-proveedor" data-proveedor="<?= htmlspecialchars(json_encode($row_proveedor), ENT_QUOTES, 'UTF-8'); ?>">Agregar</button></td>

                                <td><?= $row_proveedor['n_documentacion'] ?></td>
                                <td><?= $row_proveedor['razon_comercial'] ?></td>
                                <td><?= $row_proveedor['razon_social'] ?></td>
                                <td><?= $row_proveedor['direccion'] ?></td>
                                <td><?= $row_proveedor['departamento'] ?></td>
                            </tr>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/getProveedor.js"></script>
<script>
    $("#datos_proveedor").DataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados de la busqueda",
            info: "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Ultimo",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            sProcessing: "Procesando..",
        },
    });
</script>