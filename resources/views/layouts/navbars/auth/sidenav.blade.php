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
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mi perfil</span>
                </a>
            </li>
            @role('admin')
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'admin' ? 'active' : '' }}" href="{{ route('filament.admin.pages.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" > <title>settings</title> <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero"> <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)"> <g id="settings" transform="translate(304.000000, 151.000000)"> <polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon> <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path> <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path> </g> </g> </g> </g> </svg>

                    </div>
                    <span class="nav-link-text ms-1">Administracion</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>

</aside>
