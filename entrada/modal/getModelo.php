<div class="modal fade" id="Modelo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl custom-modal-width"> <!-- Usa la clase modal-xl para un ancho extra grande -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped text-center" id="datos_table">
                    <thead>
                        <tr>
                            <th>ACCIONES</th>
                            <th>CATEGORÍA</th>
                            <th>SUBCATEGORÍA</th>
                            <th>MARCA</th>
                            <th>SERIE</th>
                            <th>MODELO</th>
                            <th>DESCRIPCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = mysqli_query($con, "SELECT c.nombre_categoria,sc.nombre_subcategoria,ma.nombre_marca, fa.nombre_familia,mo.id_modelo,mo.nombre_modelo,mo.descripcion_modelo
                        FROM categoria c 
                        INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
                        INNER JOIN marca ma ON sc.id_subcategoria =ma.id_subcategoria
                        INNER JOIN familia fa ON ma.id_marca =fa.id_marca
                        INNER JOIN modelo mo ON fa.id_familia =mo.id_familia
                        WHERE mo.estado=1 and fa.estado = 1 and ma.estado =1 and sc.estado=1 and c.estado=1");
                        mysqli_close($con);
                        while ($row_modelo = $sql->fetch_assoc()) {  ?>
                            <tr>
                                <td><button type='button' class='btn btn-primary btn-sm agregar-modelo' data-modelo='<?= json_encode($row_modelo); ?>'>Agregar</button></td>
                                <td><?= $row_modelo['nombre_categoria']; ?></td>
                                <td><?= $row_modelo['nombre_subcategoria']; ?></td>
                                <td><?= $row_modelo['nombre_marca']; ?></td>
                                <td><?= $row_modelo['nombre_familia']; ?></td>
                                <td><?= $row_modelo['nombre_modelo']; ?></td>
                                <td class="text-start"><?= nl2br($row_modelo['descripcion_modelo']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/functions.js"></script>
<style>
    /* Personaliza el ancho del modal según tus necesidades */
    .custom-modal-width {
        max-width: 80%; /* Ajusta el valor según sea necesario */
    }
</style>
