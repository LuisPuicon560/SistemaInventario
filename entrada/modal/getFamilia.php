<div class="modal fade" id="Familia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <th>FAMILIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT c.nombre_categoria,sc.nombre_subcategoria,ma.nombre_marca, fa.nombre_familia,fa.id_familia
                                    FROM categoria c 
                                    INNER JOIN subcategoria sc ON c.id_categoria = sc.id_categoria
                                    INNER JOIN marca ma ON sc.id_subcategoria =ma.id_subcategoria
                                    INNER JOIN familia fa ON ma.id_marca =fa.id_marca
                                    WHERE fa.estado = 1 and ma.estado =1 and sc.estado=1 and c.estado=1";
                        $result = mysqli_query($con, $query);
                        mysqli_close($con);
                        while ($row_familia = $result->fetch_assoc()) {  ?>
                            <tr>
                                <td><button type='button' class='btn btn-primary btn-sm agregar-familia' data-familia='<?= json_encode($row_familia); ?>'>Agregar</button></td>
                                <td><?= $row_familia['nombre_categoria']; ?></td>
                                <td><?= $row_familia['nombre_subcategoria']; ?></td>
                                <td><?= $row_familia['nombre_marca']; ?></td>
                                <td><?= $row_familia['nombre_familia']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Data_modal/functions.js"></script>
