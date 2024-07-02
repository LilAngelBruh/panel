<?php
    $querySelectGeneros = "SELECT * FROM generos WHERE genero_estado = 1 ORDER BY genero_nombre ASC";
    $resultadoSelectGeneros = mysqli_query($conexion, $querySelectGeneros);
    $numSelectGeneros = mysqli_num_rows($resultadoSelectGeneros);
?>
<div class="modal fade" id="EditarArtista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarArtistaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditarArtistalabel">Editar Artista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="views/artistas/CRUD/crud.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="artista_id_update" id="artista_id_update">
                <div class="mb-3">
                    <label for="artista_nombre_update" class="form-label">Nuevo Nombre:</label>
                    <input type="text" name="artista_nombre_update" id="artista_nombre_update" class="form-control" required>
                </div>
                <select class="form-select mb-3" name="select_genero_update" id="select_genero_update">
                    <option value="0">Seleccione un género</option>
                    <?php
                    if ($numSelectGeneros > 0) {
                        while ($genero = mysqli_fetch_assoc($resultadoSelectGeneros)) {
                            echo '<option value="' . $genero['genero_id'] . '">' . $genero['genero_nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <div class="form-check text-start">
                    <input class="form-check-input" type="checkbox" id="artista_estado_update" name="artista_estado_update" value="">
                    <label class="form-check-label" for="artista_estado_update">
                        Deshabilitar Artista
                    </label>
                </div>
                <div class="mb-3">
                    <label for="artista_foto_update">Nueva Foto del Artista:</label>
                    <input type="file" name="artista_foto_update" id="artista_foto_update" class="form-control" accept="image/jpeg">
                </div>
                <div class="mb-3">
                    <img src="" alt="" width="100px" id="preview_artista_foto">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class='bx bxs-plus-circle'></i> Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('artista_foto_update').addEventListener('change', function() {
        var fileInput = this;
        var filePath = fileInput.value;
        var fileExtension = filePath.split('.').pop().toLowerCase();
        if (fileExtension !== 'jpeg' && fileExtension !== 'jpg') {
            alert('El formato de la imagen debe ser JPEG o JPG.');
            fileInput.value = '';
        }
    });

    document.getElementById('EditarArtista').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-body #artista_id_update');
        let inputNombre = document.querySelector('.modal-body #artista_nombre_update');
        let inputGenero = document.querySelector('.modal-body #select_genero_update');
        let inputFoto = document.querySelector('.modal-body #artista_foto_update');
        let inputFotoPreview = document.querySelector('.modal-body #preview_artista_foto');

        let getURL = "views/artistas/CRUD/getArtista.php";
        let formData = new FormData();
        formData.append('id_action_artista', id);

        fetch(getURL, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            inputId.value = data.artista_id;
            inputNombre.value = data.artista_nombre;
            inputGenero.value = data.genero_id;
            inputFoto.var = "database/images/artistas_fotos/" + data.artista_id + ".jpg";
            inputFotoPreview.src = "database/images/artistas_fotos/" + data.artista_id + ".jpg";
        })
    });
</script>
