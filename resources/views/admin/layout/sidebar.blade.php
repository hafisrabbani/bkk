<!-- Sidebar -->
@php
$data = App\Http\Controllers\adminController::getConfigWeb();
@endphp
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
        </div>
        <div class="sidebar-brand-text mx-3">{{ $data->name }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#pages" aria-expanded="true"
            aria-controls="pages">
            <i class="fas fa-file"></i>
            <span>Data Informasi</span>
        </a>
        <div id="pages" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Informasi</h6>
                <a class="collapse-item" href="{{ route('admin.loker') }}">Lowongan</a>
                <a class="collapse-item" href="{{ route('admin.post') }}">Postingan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#data" aria-expanded="true"
            aria-controls="data">
            <i class="fas fa-clipboard-list"></i>
            <span>Data Internal</span>
        </a>
        <div id="data" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Internal</h6>
                <a class="collapse-item" href="{{ route('admin.patner') }}">Perusahaan / Partner</a>
                <a class="collapse-item" href="{{ route('admin.alumni') }}">Alumni</a>
                <a class="collapse-item" href="{{ route('admin.tahun') }}">Tahun Lulus</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#setting" aria-expanded="true"
            aria-controls="data">
            <i class="fas fa-wrench"></i>
            <span>Setting</span>
        </a>
        <div id="setting" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Setting</h6>
                <a class="collapse-item" href="{{ route('admin.setting') }}">Akun</a>
                <a class="collapse-item" href="{{ route('admin.setting.page') }}">Halaman</a>
                <a class="collapse-item" href="{{ route('admin.baseconfig') }}">Basic</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">
            <i class="fas fa-sign-out-alt"></i>
            <span>logout</span></a>
    </li>
</ul>
<!-- Sidebar -->
