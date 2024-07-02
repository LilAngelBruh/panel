<div class="container py-4 text-center">
    <h2 id="seccion-albumes" class="text-center">ALBUMES</h2>
    <!-- BOTON AGREGAR NUEVO ALBUM -->
    <div class="col text-center mb-2">
        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarAlbum">
            <i class='bx bxs-plus-circle'></i> Nuevo Album
        </a>
    </div>

    <!-- Barra de búsqueda -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form id="albumBusqueda" class="form-inline justify-content-center">
                <div class="mb-3">
                    <input type="text" name="album_busqueda" id="album_busqueda" class="form-control mr-sm-2 mb-2" placeholder="Buscar..." autocomplete="off">
                </div>
                <div class="form-check text-start">
                    <input class="form-check-input" type="checkbox" value="" id="album_estado_buscar" name="album_estado_buscar" value="1">
                    <label class="form-check-label" for="album_estado_buscar">
                        Mostrar Desactivados
                    </label>
                </div>
                
                <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Buscar</button>
            </form>
        </div>
    </div>

    <!-- TABLA ALBUMES -->
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Portada</th>
                    <th>Artista</th>
                    <th>Genero</th>
                    <th>Lanzamiento</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Funciones</th>
                </tr>
            </thead>
            <tbody id="albumesTabla">
                <!-- Datos cargados dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

    <!-- PAGINACION -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="pagination">
            <!-- Páginas generadas dinámicamente -->
        </ul>
    </nav>
</div>

<?php include 'modales/ModalAgregarAlbum.php' ?>
<?php include 'modales/ModalEditarAlbum.php' ?>
<?php include 'modales/ModalEliminarAlbum.php' ?>

<script src='./views/albumes/scriptAlbumes.js'></script>

