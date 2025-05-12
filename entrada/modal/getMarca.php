<div class="modal fade" id="Marca" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Usa la clase modal-xl para un ancho extra grande -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped text-center" id="datos_table">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>CATEGORÍA</th>
                            <th>SUBCATEGORÍA</th>
                            <th>MARCA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT c.nombre_categoria,sc.nombre_subcategoria,ma.nombre_marca, ma.id_marca
                        FROM categoria c 
                        INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
                        INNER JOIN marca ma ON sc.id_subcategoria =ma.id_subcategoria
                        WHERE ma.estado = 1 and sc.estado= 1 and c.estado=1";
                        $result = mysqli_query($con, $query);
                        mysqli_close($con);
                        while ($row_marca = $result->fetch_assoc()) {  ?>
                            <tr>
                                <td><button type='button' class='btn btn-primary btn-sm agregar-marca' data-marca='<?= json_encode($row_marca); ?>'>Agregar</button></td>
                                <td><?= $row_marca['nombre_categoria']; ?></td>
                                <td><?= $row_marca['nombre_subcategoria']; ?></td>
                                <td><?= $row_marca['nombre_marca']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/functions.js"></script>

