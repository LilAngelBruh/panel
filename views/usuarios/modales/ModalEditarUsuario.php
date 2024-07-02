<div class="modal fade" id="EditarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarUsuariolabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditarUsuariolabel">Editar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="views/usuarios/CRUD/crud.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="admin_id_update" id="id_admin_update">
                    <div class="mb-3">
                        <label for="admin_username_update" class="form-label">Nuevo Username:</label>
                        <input type="text" name="admin_username_update" id="admin_username_update" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_email_update" class="form-label">Nuevo Email:</label>
                        <input type="email" name="admin_email_update" id="admin_email_update" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_password_update" class="form-label">Nueva Password:</label>
                        <input type="password" name="admin_password_update" id="admin_password_update" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_nombre_update" class="form-label">Nuevo Nombre Personal:</label>
                        <input type="text" name="admin_nombre_update" id="admin_nombre_update" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_foto_update">Nueva Foto del Usuario:</label>
                        <input type="file" name="admin_foto_update" id="admin_foto_update" class="form-control" accept="image/jpeg" required>
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
    document.getElementById('admin_foto_update').addEventListener('change', function() {
        var fileInput = this;
        var filePath = fileInput.value;
        var fileExtension = filePath.split('.').pop().toLowerCase();
        if (fileExtension !== 'jpeg' && fileExtension !== 'jpg') {
            alert('El formato de la imagen debe ser JPEG o JPG.');
            fileInput.value = '';
        }
    });

    document.getElementById('EditarUsuario').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');

        let inputId = document.querySelector('.modal-body #id_admin_update');
        let inputUsername = document.querySelector('.modal-body #admin_username_update');
        let inputEmail = document.querySelector('.modal-body #admin_email_update');
        let inputPassword = document.querySelector('.modal-body #admin_password_update');
        let inputNombre = document.querySelector('.modal-body #admin_nombre_update');
        let inputFoto = document.querySelector('.modal-body #preview_img_user');

        let getURL = "views/usuarios/CRUD/getUsuario.php";
        let formData = new FormData();
        formData.append('id_action_admin', id);

        fetch(getURL, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            inputId.value = data.administradores_id ;
            inputUsername.value = data.administrador_username;
            inputEmail.value = data.administrador_email;
            inputPassword.value = data.administrador_password;
            inputNombre.value = data.administrador_nombre;
            inputFoto.src = "database/images/admin_fotos/" + data.administradores_id + ".jpg";
        })
    });
</script>
