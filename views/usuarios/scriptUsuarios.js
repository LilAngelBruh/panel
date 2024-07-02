$(document).ready(function() {
    let resultadosPorPagina = 10; 
    let paginaActual = 1; 


    function loadUsuarios() {
        $.ajax({
            url: 'views/usuarios/CRUD/selectUsuarios.php',
            type: 'GET',
            data: { pagina: paginaActual },
            success: function(response) {
                let data = JSON.parse(response);
                actualizarTabla(data.usuarios);
                actualizarPaginacion(data.total_paginas, data.pagina_actual);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar usuarios:', error);
            }
        });
    }


    function actualizarTabla(admins) {
        let template = '';
        admins.forEach(admin => {
            template += `
                <tr>
                    <td>${admin.administradores_id}</td>
                    <td><img src="database/images/admin_fotos/${admin.administradores_id}.jpg" alt="" width="50" height="50"></td>
                    <td>${admin.administrador_username}</td>
                    <td>${admin.administrador_email}</td>
                    <td>${admin.administrador_nombre}</td>
                    <td>${admin.administrador_registro}</td>
                    <td>
                        <button class="usuario-edit btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#EditarUsuario" data-bs-id="${admin.administradores_id}"><i class='bx bx-edit-alt'></i></button>
                        <button class="usuario-delete btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#EliminarUsuario" data-bs-id="${admin.administradores_id}"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
            `;
        });

        $('#usuariosTabla').html(template);
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
        loadUsuarios();
    });

    loadUsuarios();


    $('#adminBusqueda').submit(function(event) {
        event.preventDefault();

        let busqueda = $('#admin_busqueda').val();

        $.ajax({
            url: 'views/usuarios/CRUD/selectUsuarios.php',
            type: 'POST',
            data: { admin_busqueda: busqueda, pagina: paginaActual },
            success: function(response) {
                let data = JSON.parse(response);
                actualizarTabla(data.usuarios);
                actualizarPaginacion(data.total_paginas, data.pagina_actual);
            },
            error: function(xhr, status, error) {
                console.error('Error al buscar usuarios:', error);
            }
        });
    });
});
