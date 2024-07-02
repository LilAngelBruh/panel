$(function() {

    function loadArtistas(){
        $.ajax({
            url: 'pages/artistas/CRUD/selectArtistas.php',
            type: 'GET',
            success: function(response){
                console.log(response);
                let artistas = JSON.parse(response);
                let template = '';
                artistas.forEach(artista => {
                    template += `
                    <tr artistaId="${artista.id_artista}">
                        <td>${artista.id_artista}</td>
                        <td>${artista.nombre_artista}</td>
                        <td><img src="IMAGES/fotosArtistas/${artista.id_artista}.jpg" alt="" width="50" height="50"></td>
                        <td>
                            <button class="artista-edit btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#EditarArtista" data-bs-id="${artista.id_artista}""><i class='bx bx-edit-alt'></i></button>
                            <button class="artista-delete btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#EliminarArtista" data-bs-id="${artista.id_artista}""><i class='bx bxs-trash' ></i></button>
                        </td>
                    </tr>
                    `
                });

                $('#artistasTabla').html(template);
            }
        })
    }

    
        // Selector de ID

        loadArtistas();
});