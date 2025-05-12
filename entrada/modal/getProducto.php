<div class="modal fade" id="Producto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Usa la clase modal-xl para un ancho extra grande -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped text-center" id="datos_producto">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th>AGREGAR</th>
                            <th>Subcategoria</th>
                            <th>Codigo  de referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($con, "SELECT po.id_producto, sc.nombre_subcategoria,  ma.nombre_marca, mo.nombre_modelo, po.codigo_referencia, po.stock_actual
                        FROM categoria c
                        INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
                        INNER JOIN marca ma ON sc.id_subcategoria = ma.id_subcategoria
                        INNER JOIN familia fa ON ma.id_marca = fa.id_marca
                        INNER JOIN modelo mo ON fa.id_familia = mo.id_familia
                        INNER JOIN producto po ON mo.id_modelo = po.id_modelo
                        WHERE po.estado=1 and  mo.estado=1 and fa.estado = 1 and ma.estado =1 and sc.estado=1 and c.estado=1");
                        
                        while ($row_producto = $sql->fetch_assoc()) { ?>
                            <tr>
                                <td><button type='button' class='btn btn-primary btn-sm agregar-producto' data-producto='<?= json_encode($row_producto); ?>'>Agregar</button></td>
                                <td><?= $row_producto['nombre_subcategoria']?></td>
                                <td><?= $row_producto['codigo_referencia']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/getProducto.js"></script>
<script>
     $("#datos_producto").DataTable({
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
