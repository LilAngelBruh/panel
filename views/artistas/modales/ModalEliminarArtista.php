<div class="modal fade" id="EliminarArtista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EliminarArtistalabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EliminarArtistalabel">Eliminar Artista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el Registro?
            </div>
            <div class="modal-footer">
                <form action="pages/artistas/CRUD/deleteArtista.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" name="artista_id_eliminar" id="Id_Eliminar_artista">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i>ELIMINAR</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById('EliminarArtista').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-footer #artista_id_eliminar');

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
        })
    });
</script>