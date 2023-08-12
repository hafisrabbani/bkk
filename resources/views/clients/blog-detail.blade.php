@extends('clients.layout.layout')
@section('meta')
{{ $data->meta }}
@endsection
@section('icon')
{{ ($data->thumbnail == NULL) ? asset('assets/tdk.jpg') : asset('storage/blog/thumbnail/'.$data->thumbnail) }}
@endsection
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
                                    <img class="img-fluid" src="{{ ($data->thumbnail == NULL) ? asset('assets/tdk.jpg') : asset('storage/blog/thumbnail/'.$data->thumbnail) }}">
                                </div>
                                <h3>{{ $data->judul }}</h3>
                                <div class="mt-2 mb-5">
                                    <div class="row">
                                        <div class="col-6"><span class="h6 text-secondary"><i class="fas fa-pen"></i> {{ $data->penulis }}</span></div>
                                        <div class="col-6"><span class="h6 text-secondary"><i class="fas fa-calendar"></i> {{ date('d-m-Y',strtotime($data->created_at)) }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <hr style="border-bottom: 1.5px solid #eaeaea">
                            <div class="text-dark" style="word-break: break-all">
                                {!! $data->body !!}
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
