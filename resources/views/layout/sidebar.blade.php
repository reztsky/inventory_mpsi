<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div id="TransaksiMenu">
                    <div class="sb-sidenav-menu-heading">Transaksi</div>
                    <a href="{{route('barangMasuk.index')}}" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-warehouse"></i></div>
                        Barang Masuk
                    </a>
                    <a href="{{route('barangKeluar.index')}}" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                        Barang Keluar
                    </a>
                </div>
                <div id="ReportMenu">
                    <div class="sb-sidenav-menu-heading">Report</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseReports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Static Navigation</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                        </nav>
                    </div>
                </div>
                <div id="MasterMenu">
                    <div class="sb-sidenav-menu-heading">Master</div>
                    <a href="{{route('barang.index')}}" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Barang
                    </a>
                    <a href="" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-wand-sparkles"></i></div>
                        Roles
                    </a>
                    <a href="{{route('user.index')}}" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Users
                    </a>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{auth()->user()->name}}
        </div>
    </nav>
</div>