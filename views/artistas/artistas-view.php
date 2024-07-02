<div class="container py-4 text-center">
    <h2 id="seccion-artistas" class="text-center">ARTISTAS</h2>
    <!-- BOTON AGREGAR NUEVO ARTISTA -->
    <div class="col text-center mb-2">
        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarArtista">
            <i class='bx bxs-plus-circle'></i> Nuevo Artista
        </a>
    </div>

        <!-- BARRA DE BUSQUEDA -->
        <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form id="artistaBusqueda" class="form-inline justify-content-center">
                <div class="mb-3">
                    <input type="text" name="artista_busqueda" id="artista_busqueda" class="form-control mr-sm-2 mb-2" placeholder="Buscar..." autocomplete="off">
                </div>
                <div class="form-check text-start">
                    <input class="form-check-input" type="checkbox" value="" id="artista_estado_buscar" name="artista_estado_buscar" value="1">
                    <label class="form-check-label" for="artista_estado_buscar">
                        Mostrar Desactivados
                    </label>
                </div>
                
                <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Buscar</button>
            </form>
        </div>
    </div>

    <!-- TABLA ARTISTAS -->
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Artista</th>
                    <th>Genero</th>
                    <th>Registro</th>
                    <th>Estado</th>
                    <th>Foto</th>
                    <th>Funciones</th>
                </tr>
            </thead>
            <tbody id="artistasTabla">
                <!-- Datos cargados dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<?php include 'modales/ModalAgregarArtista.php' ?>
<?php include 'modales/ModalEditarArtista.php' ?>
<?php include 'modales/ModalEliminarArtista.php' ?>

<script src='./views/artistas/scriptArtistas.js'></script>