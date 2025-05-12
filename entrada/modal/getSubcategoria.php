<div class="modal fade" id="Subcategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = mysqli_query($con, "SELECT sc.id_subcategoria, c.nombre_categoria,sc.nombre_subcategoria 
                        FROM categoria c INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
                        WHERE sc.estado = 1 and c.estado=1");
                        mysqli_close($con);
                        while ($row_subcategoria = $sql->fetch_assoc()) {  ?>
                            <tr>
                                <td><button type='button' class='btn btn-primary btn-sm agregar-subcategoria' data-subcategoria='<?= json_encode($row_subcategoria); ?>'>Agregar</button></td>
                                <td><?= $row_subcategoria['nombre_categoria']; ?></td>
                                <td><?= $row_subcategoria['nombre_subcategoria']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/functions.js"></script>
