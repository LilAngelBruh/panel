<div class="modal fade" id="AgregarGenero" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AgregarGenerolabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AgregarGenerolabel">Agregar Genero</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="views/generos/CRUD/crud.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre_genero_reg" class="form-label">Nombre Genero:</label>
                        <input type="text" name="nombre_genero_reg" id="nombre_genero_reg" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class='bx bxs-plus-circle'></i> Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Contenido opcional del pie del modal -->
            </div>
        </div>
    </div>
</div>