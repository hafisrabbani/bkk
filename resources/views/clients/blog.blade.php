@php
$configs = App\Http\Controllers\adminController::getConfigWeb();
@endphp
@extends('clients.layout.layout')
@section('meta')
Website BKK {{$configs->name}} | Dapatkan Pengumuman,Laporan Dan Informasi Menarik Disini
@endsection
@section('icon',asset('/storage/config/favicon/'.$configs->favicon))
@section('title')
Bursa Kerja Khusus {{$configs->name}}
@endsection

@section('content')
<div id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="contents text-center">
                    <h2 class="head-title wow fadeInUp">Blog BKK SMKN 1 CERME</h2>
                    <h5 class="my-fonts">"Dapatkan Pengumuman,Laporan Dan Informasi Menarik Disini"</h5>
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                    </div>
                </div>
                <div class="img-thumb text-center wow fadeInUp" data-wow-delay="0.6s">
                    <img class="img-fluid" src="{{ asset('/storage/pages/poster/'.$config->image) }}">
                </div>
                <div class="text-center mt-4 mb-4">
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
                <h4 class="text-center mb-2 f-28">Postingan Terbaru</h4>
                <hr style="width: 50%; border-bottom: 1px solid #999" class="mb-5">
                @if ($data->isEmpty())
                <h6 class="text-center text-dark">Belum Ada Postingan</h6>
                @endif
                @foreach ($data as $item)
                <div class="card box-shadow mb-3">
                    <img src="{{ ($item->thumbnail == NULL) ? asset('assets/tdk.png') : asset('storage/blog/thumbnail/'.$item->thumbnail) }}"
                        class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title my-dark">{{ $item->judul }}</h5>
                        <p class="card-text">
                        <div class="row">
                            <div class="col-6"><span class="text-secondary"><i class="fas fa-pen"></i> {{ $item->penulis
                                    }}</span></div>
                            <div class="col-6"><span class="text-secondary"><i class="fas fa-calendar"></i> {{
                                    date('d-m-Y',strtotime($item->created_at)) }}</span></div>
                        </div>
                        </p>
                        <p class="text-secondary">{{ $item->meta }}</p>
                        <div class="mt-4">
                            <a href="{{ route('blog.detail',$item->slug) }}" class="btn btn-common py-1"
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
