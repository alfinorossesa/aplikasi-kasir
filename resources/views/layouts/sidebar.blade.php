<div id="app-sidepanel" class="app-sidepanel"> 
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="/">
                <span class="logo-text" style="color: #108a53; font-size: 28px;">Aplikasi Kasir</span>
            </a>
        </div>  
        
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ Request::is('data-admin*') ? 'active' : '' }} {{ Request::is('data-kasir*') ? 'active' : '' }} {{ Request::is('stok-bahan*') ? 'active' : '' }} {{ Request::is('data-menu*') ? 'active' : '' }} {{ Request::is('data-kategori-menu*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                                    <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">Master Data</span>
                            <span class="submenu-arrow">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
                        </a>
                        <div id="submenu-1" class="collapse submenu submenu-1 {{ Request::is('data-admin*') ? 'show' : '' }} {{ Request::is('data-kasir*') ? 'show' : '' }} {{ Request::is('stok-bahan*') ? 'show' : '' }} {{ Request::is('data-menu*') ? 'show' : '' }} {{ Request::is('data-kategori-menu*') ? 'show' : '' }}" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('data-admin*') ? 'active' : '' }}" href="{{ route('data-admin.index') }}">Data Admin</a></li>
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('data-kasir*') ? 'active' : '' }}" href="{{ route('data-kasir.index') }}">Data Kasir</a></li>
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('stok-bahan*') ? 'active' : '' }}" href="{{ route('stok-bahan.index') }}">Stok Bahan</a></li>
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('data-kategori-menu*') ? 'active' : '' }}" href="{{ route('data-kategori-menu.index') }}">Data Kategori Menu</a></li>
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('data-menu*') ? 'active' : '' }}" href="{{ route('data-menu.index') }}">Data Menu</a></li>
                            </ul>
                        </div>
                    </li> 
                @endif
                
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('pemesanan*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                                <circle cx="3.5" cy="5.5" r=".5"/>
                                <circle cx="3.5" cy="8" r=".5"/>
                                <circle cx="3.5" cy="10.5" r=".5"/>
                            </svg>
                        </span>
                        <span class="nav-link-text">Transaksi</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-2" class="collapse submenu submenu-2 {{ Request::is('pemesanan*') ? 'show' : '' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ Request::is('pemesanan*') ? 'active' : '' }}" href="{{ route('pemesanan.index') }}">Pemesanan</a></li>
                        </ul>
                    </div>
                </li> 
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('laporan*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
                                <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
                            </svg>
                        </span>
                        <span class="nav-link-text">Laporan</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                    </a>
                    <div id="submenu-3" class="collapse submenu submenu-3 {{ Request::is('laporan*') ? 'show' : '' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ Request::is('laporan*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan Transaksi</a></li>
                        </ul>
                    </div>
                </li>                     
            </ul>
        </nav>
        
        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item">
                        <form action="/logout" method="POST" class="nav-link">
                        @csrf
                            <button type="submit" class="btn"><span class="nav-link-text logout-text">Logout</span> <img src="{{ asset('img/logout.png') }}" width="15px" class="logout-img"></button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>