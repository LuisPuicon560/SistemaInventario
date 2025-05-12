<div class="modal fade" id="Categoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($con, "SELECT c.* from categoria c WHERE c.estado=1");
                        mysqli_close($con);
                        while ($row_categoria = $sql->fetch_assoc()) {  ?>
                            <tr>
                                <td><button type='button' class='btn btn-primary btn-sm agregar-categoria' data-categoria='<?= json_encode($row_categoria); ?>'>Agregar</button></td>
                                <td><?= $row_categoria['nombre_categoria']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/functions.js"></script>
