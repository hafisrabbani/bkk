@extends('clients.layout.layout')
@section('title')
Bursa Kerja Khusus SMKN 1 Cerme
@endsection

@section('content')
<div id="hero-area" class="hero-area-bg" style="background-repeat:repeat-y;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-12 mb-5 mt-5">
                <div class="jumbotron jumbotron- bg-white">
                    <div class="container">
                        <div class="text-center">
                            <div class="img-thumb text-center wow fadeInUp" data-wow-delay="0.6s">
                                <img class="img-fluid"
                                    src="{{ ($detail->poster == NULL) ? asset('assets/tdk.jpg') : asset('storage/company/poster/'.$detail->poster) }}">
                            </div>
                            <h3>{{ $detail->judul }}</h3>
                            <div class="mt-2 mb-5">
                                @if ($detail->status == 1)
                                <span class="badge badge-pill badge-green">Aktif</span>
                                @else
                                <span class="badge badge-pill badge-pink">Tidak Aktif</span>
                                @endif
                                <span class="badge badge-pill badge-common">{{ $detail->company->name }}</span>
                                <span class="badge badge-pill badge-yellow">{{ $detail->position }}</span>
                            </div>
                        </div>
                        <h5 class="text-dark mb-3"><strong>Detail : </strong></h5>
                        <div class="text-dark" style="word-break: break-all">
                            {!! $detail->description !!}
                        </div>
                        <div class="text-center mt-4">
                            @if ($detail->status == 1)
                            <a href="{{ $detail->url }}" class="btn btn-common" style="width: 100%">Apply Sekarang</a>
                            @else
                            <button type="button" class="btn btn-pink" style="width: 100%;" disabled>Pendaftaran
                                Ditutup</button>
                            @endif
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="sharethis-inline-share-buttons"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- <p>{!! $detail->description !!}</p> --}}
