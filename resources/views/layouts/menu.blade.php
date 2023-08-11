<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    
    @role('Administrador')
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    <a href="/config" class="nav-link">
        <i class="fas fa-cog"></i><span>Configuración</span>
    </a>
    @endrole
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="/sensors">
        <i class=" fas fa-blog"></i><span>Sensores</span>
    </a>
</li>
