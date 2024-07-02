<div class="container py-4 text-center">
    <h2 id="seccion-generos" class="text-center">GENEROS</h2>
    <!-- BOTON AGREGAR NUEVO GENERO -->
    <div class="col text-center mb-2">
        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarGenero">
            <i class='bx bxs-plus-circle'></i> Nuevo Genero
        </a>
    </div>

    <!-- Barra de búsqueda -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form id="generoBusqueda" class="form-inline justify-content-center">
                <div class="mb-3">
                    <input type="text" name="genero_busqueda" id="genero_busqueda" class="form-control mr-sm-2 mb-2" placeholder="Buscar..." autocomplete="off">
                </div>
                <div class="form-check text-start">
                    <input class="form-check-input" type="checkbox" value="" id="genero_estado_buscar" name="genero_estado_buscar" value="1">
                    <label class="form-check-label" for="genero_estado_buscar">
                        Mostrar Desactivados
                    </label>
                </div>
                
                <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Buscar</button>
            </form>
        </div>
    </div>

    <!-- TABLA GENEROS -->
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Genero</th>
                    <th>Registro</th>
                    <th>Estado</th>
                    <th>Funciones</th>
                </tr>
            </thead>
            <tbody id="generosTabla">
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

<?php include 'modales/ModalAgregarGenero.php' ?>
<?php include 'modales/ModalEditarGenero.php' ?>
<?php include 'modales/ModalEliminarGenero.php' ?>

<script src='./views/generos/scriptGeneros.js'></script>

