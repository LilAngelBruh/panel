<div class="modal fade" id="EliminarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EliminarUsuariolabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EliminarUsuariolabel">Eliminar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el Registro?
            </div>
            <div class="modal-footer">
                <form action="views/usuarios/CRUD/crud.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" name="admin_id_eliminar" id="admin_id_eliminar">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i>ELIMINAR</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById('EliminarUsuario').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-footer #admin_id_eliminar');

        let getURL = "views/usuarios/CRUD/getUsuario.php";
        let formData = new FormData();
        formData.append('id_action_admin', id);

        fetch(getURL, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            inputId.value = data.administradores_id;
        })
    });
</script>