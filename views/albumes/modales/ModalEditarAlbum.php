<?php
    $querySelectGeneros = "SELECT * FROM generos WHERE genero_estado = 1 ORDER BY genero_nombre ASC";
    $resultadoSelectGeneros = mysqli_query($conexion, $querySelectGeneros);
    $numSelectGeneros = mysqli_num_rows($resultadoSelectGeneros);

    $querySelectArtistas = "SELECT * FROM artistas WHERE artista_estado = 1 ORDER BY artista_nombre ASC";
    $resultadoSelectArtistas = mysqli_query($conexion, $querySelectArtistas);
    $numSelectArtistas = mysqli_num_rows($resultadoSelectArtistas);
?>
<div class="modal fade" id="EditarAlbum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarAlbumlabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditarAlbumlabel">Editar Album</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="views/albumes/CRUD/crud.php" method="post" enctype="multipart/form-data" id="formEditarAlbum" autocomplete="off">

                    <input type="hidden" name="album_id_update" id="album_id_update">
                    <div class="mb-3">
                        <label for="album_titulo_update" class="form-label">Album:</label>
                        <input type="text" name="album_titulo_update" id="album_titulo_update" class="form-control" required maxlength="50" pattern="[A-Za-z0-9\s]{1,50}" title="El nombre debe contener solo letras, números y espacios, hasta 50 caracteres">
                        <div class="invalid-feedback">
                            Por favor ingrese un nombre válido para el album (máximo 50 caracteres, solo letras, números y espacios).
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="select_artista_update">Artista</label>
                        <select class="form-select" name="select_artista_update" id="select_artista_update">
                            <option value="0">Seleccione un Artista</option>
                            <?php
                            if ($numSelectArtistas > 0) {
                                while ($artista = mysqli_fetch_assoc($resultadoSelectArtistas)) {
                                    echo '<option value="' . $artista['artista_id'] . '">' . $artista['artista_nombre'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="select_genero_update">Genero</label>
                        <select class="form-select" name="select_genero_update" id="select_genero_update">
                            <option value="0">Seleccione un género</option>
                            <?php
                            if ($numSelectGeneros > 0) {
                                while ($genero = mysqli_fetch_assoc($resultadoSelectGeneros)) {
                                    echo '<option value="' . $genero['genero_id'] . '">' . $genero['genero_nombre'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="album_stock_update" class="form-label">Ingrese el stock inicial del album:</label>
                        <input type="text" name="album_stock_update" id="album_stock_update" class="form-control" oninput="validateIntegerInput(event)" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="album_duracion_update" class="form-label">Ingrese la duracion en minutos del album:</label>
                        <input type="text" name="album_duracion_update" id="album_duracion_update" class="form-control" oninput="validateIntegerInput(event)" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="album_precio_update" class="form-label">Ingrese el precio del Album:</label>
                        <input type="text" name="album_precio_update" id="album_precio_update" class="form-control" oninput="validateDecimalInput(event)" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label for="album_lanzamiento_update" class="form-label">Seleccione una fecha:</label>
                        <input type="date" name="album_lanzamiento_update" id="album_lanzamiento_update" class="form-control" required>
                    </div>
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" value="" id="album_estado_update" name="album_estado_update">
                        <label class="form-check-label" for="album_estado_update">
                            Desactivar Album
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="album_portada_update">Portada del Album:</label>
                        <input type="file" name="album_portada_update" id="album_portada_update" class="form-control" accept=".jpeg,.jpg,.jfif">
                        <div class="invalid-feedback">
                            Por favor seleccione una imagen JPEG o JPG.
                        </div>
                    </div>
                    <div class="mb-3">
                        <img src="" alt="" width=100px id="album_portada_preview">
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
    document.getElementById('album_portada_update').addEventListener('change', function() {
        var fileInput = this;
        var filePath = fileInput.value;
        // Obtener la extensión del archivo
        var fileExtension = filePath.split('.').pop().toLowerCase();
        // Verificar si la extensión es jpeg o jpg
        if (fileExtension !== 'jpeg' && fileExtension !== 'jpg' && fileExtension !== 'jfif') {
            // Si la extensión no es jpeg o jpg, mostrar un mensaje de error
            alert('El formato de la imagen debe ser JPEG ,JPG o JFIF.');
            // Limpiar el campo de entrada de archivo
            fileInput.value = '';
        }
    });

    document.getElementById('EditarAlbum').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-body #album_id_update');
        let inputTitulo = document.querySelector('.modal-body #album_titulo_update');
        let inputArtista = document.querySelector('.modal-body #select_artista_update');
        let inputGenero = document.querySelector('.modal-body #select_genero_update');
        let inputStock = document.querySelector('.modal-body #album_stock_update');
        let inputDuracion = document.querySelector('.modal-body #album_duracion_update');
        let inputPrecio = document.querySelector('.modal-body #album_precio_update');
        let inputLanzamiento = document.querySelector('.modal-body #album_lanzamiento_update');
        let inputFoto = document.querySelector('.modal-body #album_portada_update');
        let portada_preview = document.querySelector('.modal-body #album_portada_preview');

        let getURL = "views/albumes/CRUD/getAlbum.php";
        let formData = new FormData();
        formData.append('id_action_album', id);

        fetch(getURL, {
            method: "POST",
            body: formData
        })
        .then(
            response => response.json())
        .then(data => {
            inputId.value = data.album_id;
            inputTitulo.value = data.album_titulo;
            inputStock.value = data.album_stock;
            inputDuracion.value = data.album_duracion;
            inputPrecio.value = data.album_precio;
            inputLanzamiento.value = data.album_lanzamiento;
            portada_preview.src = "database/images/album_fotos/" + data.album_id + ".jpg";

            if (inputArtista && data.artista_id) {
                let opcionesArtista = inputArtista.options;
                for (let i = 0; i < opcionesArtista.length; i++) {
                    if (opcionesArtista[i].value == data.artista_id) {
                        opcionesArtista[i].selected = true;
                        break;
                    }
                }
            }

            if (inputGenero && data.genero_id) {
                let opcionesGenero = inputGenero.options;
                for (let i = 0; i < opcionesGenero.length; i++) {
                    if (opcionesGenero[i].value == data.genero_id) {
                        opcionesGenero[i].selected = true;
                        break;
                    }
                }
            }
        })
    });

    document.getElementById('formEditarAlbum').addEventListener('submit', function(event) {
        var nombreArtistaInput = document.getElementById('album_titulo_update');
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

<script>
        function validateIntegerInput(event) {
            const input = event.target;
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        function validateDecimalInput(event) {
            const input = event.target;
            input.value = input.value.replace(/[^0-9.]/g, '');
            if ((input.value.match(/\./g) || []).length > 1) {
                input.value = input.value.slice(0, -1);
            }
        }
</script>
