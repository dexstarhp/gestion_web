<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="{{ asset('/img/logotipo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Sistema de control</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#compras" class="nav-link active" aria-controls="compras" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Compras</span>
                </a>
                <div class="collapse {{ (Route::currentRouteName() == 'proveedores.index' || Route::currentRouteName() == 'proveedores.create' || Route::currentRouteName() == 'proveedores.edit' || Route::currentRouteName() == 'compra.index' || Route::currentRouteName() == 'compra.create' || Route::currentRouteName() == 'compra.edit') ? 'show' : '' }}" id="compras" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item {{ (Route::currentRouteName() == 'proveedores.index' || Route::currentRouteName() == 'proveedores.create' || Route::currentRouteName() == 'proveedores.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'proveedores.index' || Route::currentRouteName() == 'proveedores.create' || Route::currentRouteName() == 'proveedores.edit') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Proveedores </span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'compra.index' || Route::currentRouteName() == 'compra.create' || Route::currentRouteName() == 'compra.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'compra.index' || Route::currentRouteName() == 'compra.create' || Route::currentRouteName() == 'compra.edit') ? 'active' : ''}}" href="{{ route('compra.index') }}">
                                <span class="sidenav-mini-icon"> RC </span>
                                <span class="sidenav-normal"> Registro de compra </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#invetarios" class="nav-link active" aria-controls="invetarios" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inventarios</span>
                </a>
                <div class="collapse
                {{ (Route::currentRouteName() == 'items.index' || Route::currentRouteName() == 'items.create' || Route::currentRouteName() == 'items.edit' || Route::currentRouteName() == 'entrada.index' || Route::currentRouteName() == 'entrada.create' || Route::currentRouteName() == 'entrada.edit' || Route::currentRouteName() == 'salida.index' || Route::currentRouteName() == 'salida.create' || Route::currentRouteName() == 'salida.edit') ? 'show' : '' }}"
                    id="invetarios" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item {{ (Route::currentRouteName() == 'items.index' || Route::currentRouteName() == 'items.create' || Route::currentRouteName() == 'items.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'items.index' || Route::currentRouteName() == 'items.create' || Route::currentRouteName() == 'items.edit') ? 'active' : '' }}" href="{{ route('items.index') }}">
                                <span class="sidenav-mini-icon"> I </span>
                                <span class="sidenav-normal"> Items </span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'entrada.index' || Route::currentRouteName() == 'entrada.create' || Route::currentRouteName() == 'entrada.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'entrada.index' || Route::currentRouteName() == 'entrada.create' || Route::currentRouteName() == 'entrada.edit') ? 'active' : '' }}" href="{{ route('entrada.index') }}">
                                <span class="sidenav-mini-icon"> E </span>
                                <span class="sidenav-normal">Registro de Entradas </span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'salida.index' || Route::currentRouteName() == 'salida.create' || Route::currentRouteName() == 'salida.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'salida.index' || Route::currentRouteName() == 'salida.create' || Route::currentRouteName() == 'salida.edit') ? 'active' : '' }}" href="{{ route('salida.index') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal">Registro de Salidas </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#ventas" class="nav-link active" aria-controls="ventas" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ventas</span>
                </a>
                <div class="collapse
                    {{ (Route::currentRouteName() == 'cliente.index' || Route::currentRouteName() == 'cliente.create' || Route::currentRouteName() == 'cliente.edit' || Route::currentRouteName() == 'venta.index' || Route::currentRouteName() == 'venta.create' || Route::currentRouteName() == 'venta.edit') ? 'show' : '' }}"
                    id="ventas" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item {{ (Route::currentRouteName() == 'cliente.index' || Route::currentRouteName() == 'cliente.create' || Route::currentRouteName() == 'cliente.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'cliente.index' || Route::currentRouteName() == 'cliente.create' || Route::currentRouteName() == 'cliente.edit') ? 'active' : '' }}" href="{{ route('cliente.index') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal"> Clientes </span>
                            </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'venta.index' || Route::currentRouteName() == 'venta.create' || Route::currentRouteName() == 'venta.edit') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'venta.index' || Route::currentRouteName() == 'venta.create' || Route::currentRouteName() == 'venta.edit') ? 'active' : '' }}" href="{{ route('venta.index') }}">
                                <span class="sidenav-mini-icon"> RV </span>
                                <span class="sidenav-normal">Registro de Ventas </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#reporte" class="nav-link active" aria-controls="reporte" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reportes</span>
                </a>
                <div class="collapse
                    {{ (Route::currentRouteName() == 'kardex.index') ? 'show' : '' }}"
                    id="reporte" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item {{ (Route::currentRouteName() == 'kardex.index') ? 'active' : '' }}">
                            <a class="nav-link {{ (Route::currentRouteName() == 'kardex.index') ? 'active' : '' }}" href="{{ route('kardex.index') }}">
                                <span class="sidenav-mini-icon"> K </span>
                                <span class="sidenav-normal"> Kardex </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuraciones</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'user-management' ? 'active' : '' }}" href="{{ route('user-management') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Gestor de usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mi perfil</span>
                </a>
            </li>

        </ul>
    </div>

</aside>
