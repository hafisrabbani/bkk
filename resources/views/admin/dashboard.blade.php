@extends('admin.layout.extend')
@section('title')
Pengaturan
@endsection

@section('page-name')
Pengaturan
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Alumni</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $alumni }} Alumni</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kemitraan DU/DI</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mitra }} Mitra</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Lowongan Pekerjaan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $loker }} Loker</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bullhorn fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Postingan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $post }} Postingan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paste fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="">
                    <canvas id="myChart" width="641px" height=""></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Belum Bekerja', 'Kerja', 'Kuliah', ],
            datasets: [{
                label: 'Total',
                data: [
                    "{{ $chart[0] }}",
                    "{{ $chart[1] }}",
                    "{{ $chart[2] }}",
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush


{{-- width: ; height: 320px; --}}