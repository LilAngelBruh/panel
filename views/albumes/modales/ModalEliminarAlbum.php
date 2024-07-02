<div class="modal fade" id="EliminarAlbum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EliminarAlbumlabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EliminarAlbumlabel">Eliminar Album</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el Registro?
            </div>
            <div class="modal-footer">
                <form action="views/albumes/CRUD/crud.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" name="album_id_delete" id="album_id_delete">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i>ELIMINAR</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById('EliminarAlbum').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-footer #album_id_delete');

        let getURL = "views/albumes/CRUD/getAlbum.php";
        let formData = new FormData();
        formData.append('id_action_album', id);

        fetch(getURL, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            inputId.value = data.album_id;
        })
        .catch(err => console.log(err));
    });
</script>