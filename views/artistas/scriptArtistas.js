$(document).ready(function() {
    let resultadosPorPagina = 10; 
    let paginaActual = 1; 

    function loadArtistas() {
        let estadoCheckbox = $('#artista_estado_buscar').is(':checked') ? 1 : 0;

        $.ajax({
            url: 'views/artistas/CRUD/selectArtistas.php',
            type: 'GET',
            data: { pagina: paginaActual, artista_estado_buscar: estadoCheckbox },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.error) {
                    console.error('Error al cargar artistas:', data.error);
                } else {
                    actualizarTabla(data.artistas);
                    actualizarPaginacion(data.total_paginas, data.pagina_actual);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar artistas:', error);
            }
        });
    }

    function actualizarTabla(artistas) {
        let template = '';
        artistas.forEach(artista => {
            template += `
                <tr>
                    <td>${artista.artista_id}</td>
                    <td>${artista.artista_nombre}</td>
                    <td>${artista.genero_nombre}</td>
                    <td>${artista.artista_registro}</td>
                    <td>${artista.artista_estado}</td>
                    <td><img src="database/images/artistas_fotos/${artista.artista_id}.jpg" alt="" width="50" height="50"></td>
                    <td>
                        <button class="artista-edit btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#EditarArtista" data-bs-id="${artista.artista_id}"><i class='bx bx-edit-alt'></i></button>
                        <button class="artista-delete btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#EliminarArtista" data-bs-id="${artista.artista_id}"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
            `;
        });

        $('#artistasTabla').html(template);
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
        loadArtistas();
    });

    $('#artistaBusqueda').submit(function(event) {
        event.preventDefault();

        let busqueda = $('#artista_busqueda').val();
        let estadoCheckbox = $('#artista_estado_buscar').is(':checked') ? 1 : 0;

        $.ajax({
            url: 'views/artistas/CRUD/selectArtistas.php',
            type: 'POST',
            data: { artista_buscar: busqueda, pagina: paginaActual, artista_estado_buscar: estadoCheckbox },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.error) {
                    console.error('Error al buscar artistas:', data.error);
                } else {
                    actualizarTabla(data.artistas);
                    actualizarPaginacion(data.total_paginas, data.pagina_actual);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al buscar artistas:', error);
            }
        });
    });

    $('#artista_estado_buscar').change(function() {
        paginaActual = 1; // Reset the page to 1 when changing the filter
        loadArtistas();
    });

    loadArtistas();
});
