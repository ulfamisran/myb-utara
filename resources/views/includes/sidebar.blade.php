<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/admin/dashboardview">  <span
                    class="logo-name">DATA SUARA</span>
            </a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
            <img alt="image" src="{{url('img/logo-app1.png')}}" width="1000">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">TIM - MYB</div>
                <!-- <div class="user-role">Sekretaris Desa</div> -->
            </div>
        </div>
        <hr>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
                <a href="/admin/dashboardview" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
            <a href="/admin/persebarantpsview/0/0"><i data-feather="map"></i><span>Persebaran Pemilih [TPS]</span></a>
            </li>
            <li class="dropdown">
            <a href="/admin/persebarantimview/0/0"><i data-feather="map"></i><span>Persebaran Pemilih [TIM]</span></a>
            </li>
            <!-- <li class="dropdown">
                <a href="#" class="nav-link"><i data-feather="home"></i><span>Info Desa</span></a>
            </li> -->
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="database"></i><span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/admin/kecamatanview">Data Kecamatan</a></li>
                    <li><a class="nav-link" href="/admin/kelurahanview/0">Data Kelurahan</a></li>
                    <li><a class="nav-link" href="/admin/tpsview/0/0">Data TPS</a></li>
                </ul>
            </li>

            <li class="menu-header">Data TIM MYB</li>
            <li class="dropdown">
                <a href="/admin/pallawaview" class="nav-link "><i data-feather="file-text"></i><span>Data Pallawa</span></a>
            </li>
            <li class="dropdown">
                <a href="/admin/patappaview/0" class="nav-link "><i data-feather="file-text"></i><span>Data Patappa</span></a>
            </li>
            <!-- <li class="dropdown">
                <a href="/admin/saksi/view" class="nav-link "><i data-feather="file-text"></i><span>Data Saksi</span></a>
            </li> -->

            <li class="menu-header">Data Pemilih MYB</li>
            <li class="dropdown">
                <a href="/admin/pemilihbytpsview/0/0/0" class="nav-link "><i data-feather="inbox"></i><span>Data Pemilih [TPS]</span></a>
            </li>
            <li class="dropdown">
                <a href="/admin/pemilihbytimview/0/0" class="nav-link "><i data-feather="mail"></i><span>Data Pemilih [TIM MYB]</span></a>
            </li>

            <li class="menu-header">User</li>
            <li class="dropdown">
                <a href="/admin/userview" class="nav-link "><i data-feather="user"></i><span>Data User</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link "><i data-feather="repeat"></i><span>Ubah Password</span></a>
            </li>
        </ul>
    </aside>
</div>
