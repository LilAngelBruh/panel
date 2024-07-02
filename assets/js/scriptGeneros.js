$(function() {

    function loadGeneros(){
        $.ajax({
            url: 'pages/generos/CRUD/selectGenero.php',
            type: 'GET',
            success: function(response){
                console.log(response);
                let generos = JSON.parse(response);
                let template = '';
                generos.forEach(genero => {
                    template += `
                    <tr generoId="${genero.id_genero}">
                        <td>${genero.id_genero}</td>
                        <td>${genero.nombre_genero}</td>
                        <td>
                            <button class="genero-edit btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#EditarGenero" data-bs-id="${genero.id_genero}""><i class='bx bx-edit-alt'></i></button>
                            <button class="genero-delete btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#EliminarGenero" data-bs-id="${genero.id_genero}""><i class='bx bxs-trash' ></i></button>
                        </td>
                    </tr>
                    `
                });

                $('#generosTabla').html(template);
            }
        })
    }

    
        // Selector de ID

        loadGeneros();
});