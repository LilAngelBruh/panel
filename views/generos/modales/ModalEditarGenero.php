<div class="modal fade" id="EditarGenero" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditarGenerolabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditarGenerolabel">Editar Genero</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="views/generos/CRUD/crud.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="genero_id_update" id="genero_id_update">
                    <div class="mb-3">
                        <label for="nombre_genero_update" class="form-label">Nuevo Genero:</label>
                        <input type="text" name="nombre_genero_update" id="nombre_genero_update" class="form-control" required>
                    </div>
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" value="" id="genero_estado_update" name="genero_estado_update">
                        <label class="form-check-label" for="genero_estado_update">
                            Deshabilitar Genero
                        </label>
                    </div>
                    <div class="mb-3 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class='bx bxs-plus-circle'></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('EditarGenero').addEventListener('shown.bs.modal', function(event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        console.log(id);

        let inputId = document.querySelector('.modal-body #genero_id_update');
        let inputGenero = document.querySelector('.modal-body #nombre_genero_update');

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
            inputGenero.value = data.genero_nombre;
        })
        .catch(err => console.log(err));
    });
</script>