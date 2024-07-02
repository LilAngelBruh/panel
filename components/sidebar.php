<div class="menu">
    <box-icon name="menu"></box-icon>
    <box-icon name="cross"></box-icon>
</div>
<div class="barra-lateral">
    <div class="nombre-pagina">
        <i class="bx bxl-less" id="openMenu"></i>
        <span>BLACK <span class="miidii">MIIDII</span></span>
    </div>
    <nav class="navegacion">
        <ul>
        <li>
            <a class="list-group-item" id="dashboard" href="<?php echo APP_URL ?>dashboard">
            <box-icon name="dashboard" type="solid"></box-icon>
            <span>dashboard</span>
            </a>
        </li>
        <li>
            <a class="list-group-item" href="<?php echo APP_URL ?>albumes">
            <box-icon name="album" type="solid"></box-icon>
            <span>albumes</span>
            </a>
        </li>
        <li>
            <a class="list-group-item" href="<?php echo APP_URL ?>artistas">
            <box-icon name="microphone-alt" type="solid"></box-icon>
            <span>Artistas</span>
            </a>
        </li>
        <li>
            <a class="list-group-item" href="<?php echo APP_URL ?>generos">
            <box-icon name="music" type="solid"></box-icon>
            <span>Generos</span>
            </a>
        </li>
        <li>
            <a class="list-group-item" href="<?php echo APP_URL ?>usuarios">
            <box-icon name="user" type="solid"></box-icon>
            <span>Usuarios</span>
            </a>
        </li>
        <li>
            <a href="<?php echo APP_URL ?>login">
            <box-icon name="exit" type="solid"></box-icon>
            <span>Cerrar Sesion</span>
            </a>
        </li>
        </ul>
    </nav>
    <div>
        <div class="linea"></div>
        <div class="usuario">
        <img src="<?php echo $_SESSION['foto_usuario']; ?>" alt="" />
        <div class="info-usuario">
            <div class="nombre-email">
            <span class="nombre"><?php echo $_SESSION['nombre_usuario']; ?></span>
            <span class="email"><?php echo $_SESSION['email_usuario']; "hola" ?></span>
            </div>
            <box-icon name="dots-vertical-rounded"></box-icon>
        </div>
        </div>
    </div>
</div>
