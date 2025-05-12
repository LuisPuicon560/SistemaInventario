<!-- Modal -->
<div class="modal fade" id="delete-categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- recogemos los datos -->
            <div class="modal-body">
                ¿Deseas eliminar registro?
            </div>
            <div class="modal-footer">

                <form action="../crud/eliminar_categoria.php" method="POST">
                    <input type="hidden" id="id" name="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="ok">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>