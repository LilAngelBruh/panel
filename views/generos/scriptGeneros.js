$(document).ready(function() {
    let resultadosPorPagina = 10; 
    let paginaActual = 1; 

    function loadGeneros() {
        let estadoCheckbox = $('#genero_estado_buscar').is(':checked') ? 1 : 0;

        $.ajax({
            url: 'views/generos/CRUD/selectGeneros.php',
            type: 'GET',
            data: { pagina: paginaActual, genero_estado_buscar: estadoCheckbox },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.error) {
                    console.error('Error al cargar generos:', data.error);
                } else {
                    actualizarTabla(data.generos);
                    actualizarPaginacion(data.total_paginas, data.pagina_actual);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar generos:', error);
            }
        });
    }

    function actualizarTabla(generos) {
        let template = '';
        generos.forEach(genero => {
            template += `
                <tr>
                    <td>${genero.genero_id}</td>
                    <td>${genero.genero_nombre}</td>
                    <td>${genero.genero_registro}</td>
                    <td>${genero.genero_estado}</td>
                    <td>
                        <button class="genero-edit btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#EditarGenero" data-bs-id="${genero.genero_id}"><i class='bx bx-edit-alt'></i></button>
                        <button class="genero-delete btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#EliminarGenero" data-bs-id="${genero.genero_id}"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
            `;
        });

        $('#generosTabla').html(template);
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
        loadGeneros();
    });

    $('#generoBusqueda').submit(function(event) {
        event.preventDefault();

        let busqueda = $('#genero_busqueda').val();
        let estadoCheckbox = $('#genero_estado_buscar').is(':checked') ? 1 : 0;

        $.ajax({
            url: 'views/generos/CRUD/selectGeneros.php',
            type: 'POST',
            data: { genero_busqueda: busqueda, pagina: paginaActual, genero_estado_buscar: estadoCheckbox },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.error) {
                    console.error('Error al buscar generos:', data.error);
                } else {
                    actualizarTabla(data.generos);
                    actualizarPaginacion(data.total_paginas, data.pagina_actual);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al buscar generos:', error);
            }
        });
    });

    $('#genero_estado_buscar').change(function() {
        paginaActual = 1; // Reset the page to 1 when changing the filter
        loadGeneros();
    });

    loadGeneros();
});
