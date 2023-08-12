@php
$config = App\Http\Controllers\adminController::getConfigWeb();
@endphp
@extends('clients.layout.layout')
@section('meta')
Website {{ $config->name }} | Halaman Postingan
@endsection
@section('icon',asset('/storage/config/favicon/'.$config->favicon))
@section('title')
Bursa Kerja Khusus {{ $config->name }}
@endsection

@section('content')
<div id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="contents text-center">
                    <h2 class="head-title wow fadeInUp">{{ $data->header }}</h2>
                    <h5 class="my-fonts">{{ $data->content }}</h5>
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                    </div>
                </div>
                <div class="img-thumb text-center wow fadeInUp" data-wow-delay="0.6s">

                    <img class="img-fluid" src="{{ asset('/storage/pages/poster/'.$data->image) }}">

                </div>
                <div class="text-center mt-4 mb-4">
                    <a href="#lokers" class="btn btn-common">Jelajahi</a>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
<div id="feature">
    <div class="container-fluid" id="lokers">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md -8 col-sm-12 mb-5">
                <h4 class="text-center mb-2 f-28">Lowongan Kerja Terbaru</h4>
                <hr style="width: 50%; border-bottom: 1px solid #999" class="mb-5">
                @if ($dataLoker->isEmpty())
                <h6 class="text-center text-dark">Belum Ada Lowongan Pekerjaan</h6>
                @endif
                @foreach ($dataLoker as $item)
                <div class="card box-shadow mb-3">
                    <img src="{{ ($item->poster == NULL) ? asset('assets/tdk.png') : asset('storage/company/poster/'.$item->poster) }}"
                        class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title my-dark">{{ $item->judul }}</h5>
                        <p class="card-text">
                            @if ($item->status === 1)
                            <span class="badge badge-pill badge-green">Aktif</span>
                            @else
                            <span class="badge badge-pill badge-pink">Tidak Aktif</span>
                            @endif
                            <span class="badge badge-pill badge-common">{{ $item->company->name }}</span>
                            <span class="badge badge-pill badge-yellow">{{ $item->position }}</span>
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ route('clients.loker.detail',$item->id) }}" class="btn btn-common py-1"
                                style="background-color:#283f81; width:80%; border-radius: 5px;">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
