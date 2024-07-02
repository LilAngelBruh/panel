<?php
    $querySelectGeneros = "SELECT * FROM generos WHERE genero_estado = 1 ORDER BY genero_nombre ASC";
    $resultadoSelectGeneros = mysqli_query($conexion, $querySelectGeneros);
    $numSelectGeneros = mysqli_num_rows($resultadoSelectGeneros);
?>
<div class="modal fade" id="AgregarArtista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AgregarArtistalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AgregarArtistalabel">Agregar Artista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="views/artistas/CRUD/crud.php" method="post" enctype="multipart/form-data" id="formAgregarArtista" autocomplete="off">
                    <div class="mb-3">
                        <label for="artista_nombre_reg" class="form-label">Artista:</label>
                        <input type="text" name="artista_nombre_reg" id="artista_nombre_reg" class="form-control" required maxlength="50" pattern="[A-Za-z0-9\s]{1,50}" title="El nombre debe contener solo letras, números y espacios, hasta 50 caracteres">
                        <div class="invalid-feedback">
                            Por favor ingrese un nombre válido para el artista (máximo 50 caracteres, solo letras, números y espacios).
                        </div>
                    </div>
                    <select class="form-select" name="select_genero_reg" id="select_genero_reg">
                        <option value="0">Seleccione un género</option>
                        <?php
                        if ($numSelectGeneros > 0) {
                            while ($genero = mysqli_fetch_assoc($resultadoSelectGeneros)) {
                                echo '<option value="' . $genero['genero_id'] . '">' . $genero['genero_nombre'] . '</option>';
                            }
                        }
                        ?>
                    </select>


                    <div class="mb-3">
                        <label for="artista_foto_reg">Foto del Artista:</label>
                        <input type="file" name="artista_foto_reg" id="artista_foto_reg" class="form-control" required accept=".jpeg,.jpg">
                        <div class="invalid-feedback">
                            Por favor seleccione una imagen JPEG o JPG.
                        </div>
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


<script>
    document.getElementById('artista_foto_reg').addEventListener('change', function() {
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

    document.getElementById('formAgregarArtista').addEventListener('submit', function(event) {
        var nombreArtistaInput = document.getElementById('artista_nombre_reg');
        if (!nombreArtistaInput.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            nombreArtistaInput.classList.add('is-invalid');
        } else {
            nombreArtistaInput.classList.remove('is-invalid');
        }
        this.classList.add('was-validated');
    });
</script>
