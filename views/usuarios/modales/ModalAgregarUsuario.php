<div class="modal fade" id="AgregarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AgregarUsuariolabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AgregarUsuariolabel">Agregar Artista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="views/usuarios/CRUD/crud.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="mb-3">
                        <label for="admin_username_reg" class="form-label">Username:</label>
                        <input type="text" name="admin_username_reg" id="admin_username_reg" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_email_reg" class="form-label">Email:</label>
                        <input type="email" name="admin_email_reg" id="admin_email_reg" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Password:</label>
                        <input type="password" name="admin_password" id="admin_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_nombre_reg" class="form-label">Nombre Personal:</label>
                        <input type="text" name="admin_nombre_reg" id="admin_nombre_reg" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_foto_reg">Foto del Usuario:</label>
                        <input type="file" name="admin_foto_reg" id="admin_foto_reg" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="admin_reg"><i class='bx bxs-plus-circle'></i> Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Contenido opcional del pie del modal -->
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('admin_foto_reg').addEventListener('change', function() {
        var fileInput = this;
        var filePath = fileInput.value;
        // Obtener la extensión del archivo
        var fileExtension = filePath.split('.').pop().toLowerCase();
        // Verificar si la extensión es jpeg o jpg
        if (fileExtension !== 'jpeg' && fileExtension !== 'jpg') {
            // Si la extensión no es jpeg o jpg, mostrar un mensaje de error
            alert('El formato de la imagen debe ser JPEG o JPG.');
            // Limpiar el campo de entrada de archivo
            fileInput.value = '';
        }
    });
</script>