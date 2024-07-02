$(document).ready(function() {
    let resultadosPorPagina = 10;
    let paginaActual = 1;

    function loadAlbumes() {
        let estadoCheckbox = $('#album_estado_buscar').is(':checked') ? 1 : 0;

        $.ajax({
            url: 'views/albumes/CRUD/selectAlbumes.php',
            type: 'GET',
            data: { pagina: paginaActual, album_estado_buscar: estadoCheckbox },
            success: function(response) {
                console.log(response); // Agrega este log para ver la respuesta del servidor
                let data = JSON.parse(response);
                if (data.error) {
                    console.error('Error al cargar albumes:', data.error);
                } else {
                    actualizarTabla(data.albumes);
                    actualizarPaginacion(data.total_paginas, data.pagina_actual);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición:', status, error);
            }
        });
    }

    function actualizarTabla(albumes) {
        let template = '';
        albumes.forEach(album => {
            template += `
                <tr>
                    <td>${album.album_id}</td>
                    <td>${album.album_titulo}</td>
                    <td><img src="database/images/album_fotos/${album.album_id}.jpg" alt="Foto de ${album.album_titulo}" width="50" height="50"></td>
                    <td>${album.artista_nombre}</td>
                    <td>${album.genero_nombre}</td>
                    <td>${album.album_lanzamiento}</td>
                    <td>${album.album_stock}</td>
                    <td>${album.album_precio}</td>
                    <td>${album.album_estado}</td>
                    <td>
                        <button class="album-edit btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#EditarAlbum" data-bs-id="${album.album_id}"><i class='bx bx-edit-alt'></i></button>
                        <button class="album-delete btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#EliminarAlbum" data-bs-id="${album.album_id}"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
            `;
        });

        $('#albumesTabla').html(template);
    }

    function actualizarPaginacion(totalPaginas, paginaActual) {
        let template = '';

        for (let i = 1; i <= totalPaginas; i++) {
            template += `
                <li class="page-item ${i === paginaActual ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }

        $('#pagination').html(template);
    }

    $(document).on('click', '.page-link', function(event) {
        event.preventDefault();
        paginaActual = $(this).data('page');
        loadAlbumes();
    });

    $('#albumBusqueda').submit(function(event) {
        event.preventDefault();

        let busqueda = $('#album_busqueda').val();
        let estadoCheckbox = $('#album_estado_buscar').is(':checked') ? 1 : 0;

        $.ajax({
            url: 'views/albumes/CRUD/selectAlbumes.php',
            type: 'POST',
            data: { album_busqueda: busqueda, pagina: paginaActual, album_estado_buscar: estadoCheckbox },
            success: function(response) {
                console.log(response); // Agrega este log para ver la respuesta del servidor
                let data = JSON.parse(response);
                if (data.error) {
                    console.error('Error al buscar albumes:', data.error);
                } else {
                    actualizarTabla(data.albumes);
                    actualizarPaginacion(data.total_paginas, data.pagina_actual);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición:', status, error);
            }
        });
    });

    $('#album_estado_buscar').change(function() {
        paginaActual = 1; // Reset the page to 1 when changing the filter
        loadAlbumes();
    });

    loadAlbumes();
});
