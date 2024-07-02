<div class="container py-4 text-center">
    <h2 id="seccion-usuarios" class="text-center">USUARIOS</h2>

    <!-- Botón para agregar nuevo usuario -->
    <div class="col text-center mb-2">
        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarUsuario">
            <i class='bx bxs-plus-circle'></i> Nuevo Usuario
        </a>
    </div>

    <!-- Barra de búsqueda -->
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form id="adminBusqueda" class="form-inline justify-content-center">
                <input type="text" name="admin_busqueda" id="admin_busqueda" class="form-control mr-sm-2 mb-2" placeholder="Buscar..." autocomplete="off">
                <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Id Usuario</th>
                    <th>Foto Usuario</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Fecha Registro</th>
                    <th>Funciones</th>
                </tr>
            </thead>
            <tbody id="usuariosTabla">
                <!-- Datos cargados dinámicamente -->
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="pagination">
            <!-- Páginas generadas dinámicamente -->
        </ul>
    </nav>
</div>

<?php include 'modales/ModalAgregarUsuario.php' ?>
<?php include 'modales/ModalEditarUsuario.php' ?>
<?php include 'modales/ModalEliminarUsuario.php' ?>

<script src='./views/usuarios/scriptUsuarios.js'></script>
