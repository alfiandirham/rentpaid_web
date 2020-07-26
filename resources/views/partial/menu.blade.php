<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header mb-3">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="/dashboard">
                        <div class="brand-logo"></div>
                    </a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><router-link to="/dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></router-link>
                </li>
                <li class=" navigation-header"><span>MASTER</span>
                </li>
                @cannot('isAdmin')
                <li class=" nav-item"><router-link to="/locations"><i class="fa fa-map-marker"></i><span class="menu-title" data-i18n="Email">Lokasi</span></router-link>
                </li>
                @endcan
                <li class=" nav-item"><a><i class="feather icon-box"></i><span class="menu-title">Tenant</span></a>
                    <ul class="menu-content">
                        <li><router-link to="/tenants"><i class="feather icon-circle"></i><span class="menu-item">Daftar Tenant</span></router-link>
                        </li>
                        <li><router-link to="/tarif"><i class="feather icon-circle"></i><span class="menu-item">Tarif</span></router-link>
                        </li>
                        <li><router-link to="/kategori"><i class="feather icon-circle"></i><span class="menu-item">Kategori</span></router-link>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><router-link to="/users"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Todo">Users</span></router-link>
                </li>
                <li class=" nav-item"><router-link to="/penyewa"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Todo">Penyewa</span></router-link>
                </li>
                <li class=" navigation-header"><span>REPORT</span>
                </li>
                <li class=" nav-item"><router-link to="/transaksi"><i class="fa fa-usd"></i><span class="menu-title" data-i18n="Data List">Transaksi</span></router-link>
                </li>
                <li class=" nav-item"><router-link to="/tunggakan"><i class="feather icon-info"></i><span class="menu-title" data-i18n="Data List">Tunggakan Pembayaran</span></router-link>
                </li>
                <li class=" nav-item"><router-link to="/setor"><i class="fa fa-arrow-circle-o-down"></i><span class="menu-title" data-i18n="Data List">Setoran</span></router-link>
                </li>
                <li class=" navigation-header"><span>Akun</span>
                </li>
                <li class=" nav-item"><router-link to="/profile"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Profile">Profil Pengguna</span></router-link>
                </li>
                <li class=" nav-item"><router-link to="/perusahaan"><i class="feather icon-info"></i><span class="menu-title" data-i18n="Knowledge Base">Info Perusahaan</span></router-link>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->