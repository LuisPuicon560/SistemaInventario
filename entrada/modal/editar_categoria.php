<!-- Modal -->
<div class="modal fade" id="edit-categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- recogemos los datos -->
            <div class="modal-body text-center">
                <form action="../crud/actualizar_categoria.php" method="POST">
                    <!-- el dato id_categoria -->
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="categoria">Nombre de la categoria:</label>
                        <input type="text" name="categoria" id="Categoria" placeholder="Escribe el nombre de la categoría">
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="ok">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Evitar el envío del formulario al presionar "Enter"
    document.querySelector("#edit-categoria form").addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            return false;
        }
    });
</script>
