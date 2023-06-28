<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <!-- ============================================================== -->
                    <!-- DASHBOARD  -->
                    <!-- ============================================================== -->
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- EMPRESA  -->
                    <!-- ============================================================== -->
                    @if(auth()->user()->admin)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-building"></i>Empresas</a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('components.empresas.index') }}">Lista de Empresas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('components.empresas.create') }}">Nueva Empresa</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    
                    <!-- ============================================================== -->
                    <!-- VEHICULOS  -->
                    <!-- ============================================================== -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fa fa-fw fa-car"></i>Vehiculos</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('components.vehiculos.index') }}">Lista de Vehiculos</a>
                                </li>
                                @if(auth()->user()->admin)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('components.vehiculos.create') }}">Nuevo Vehiculo</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    <!-- ============================================================== -->
                    <!-- MAPAS  -->
                    <!-- ============================================================== -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw fa-map-marker-alt"></i>Rastreo</a>
                        <div id="submenu-9" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('components.mapas.localizaciones') }}">Localizaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('components.mapas.notificaciones') }}">Notificaciones</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>