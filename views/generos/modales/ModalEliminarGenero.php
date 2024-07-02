<div class="modal fade" id="EliminarGenero" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EliminarGenerolabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EliminarGenerolabel">Eliminar Genero</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el Registro?
            </div>
            <div class="modal-footer">
                <form action="views/generos/CRUD/crud.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" name="genero_id_delete" id="genero_id_delete">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i>ELIMINAR</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById('EliminarGenero').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-footer #genero_id_delete');

        let getURL = "views/generos/CRUD/getGenero.php";
        let formData = new FormData();
        formData.append('id_action_genero', id);

        fetch(getURL, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            inputId.value = data.genero_id;
        })
        .catch(err => console.log(err));
    });
</script>