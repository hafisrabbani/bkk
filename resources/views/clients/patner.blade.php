@extends('clients.layout.layout')
@section('title')
    Bursa Kerja Khusus SMKN 1 Cerme
@endsection

@section('content')
    <div id="hero-area" class="hero-area-bg" style="height:auto">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="contents text-center">
                        <h2 class="head-title wow fadeInUp">Perusahaan Mitra SMKN 1 CERME</h2>
                        <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($data as $item)
                            <div class="col-md-4">
                                <div class="card box-shadow mb-3">
                                    <img src="{{ ($item->logo == NULL) ? asset('storage/assets/tdk.png') : asset('storage/company/logo/'.$item->logo) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title my-dark">{{ $item->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection