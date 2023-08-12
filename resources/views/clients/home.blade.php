@php
$config = App\Http\Controllers\adminController::getConfigWeb();
@endphp
@extends('clients.layout.layout')
@section('title')
Bursa Kerja Khusus SMKN 1 Cerme
@endsection
@section('icon',asset('/storage/config/favicon/'.$config->favicon))
@section('content')
<div id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="contents text-center">
                    <h2 class="head-title wow fadeInUp">Bursa Kerja Khusus SMKN 1 Cerme</h2>
                    <h5 class="my-fonts">"Profesional, Kompetitif dan Berkualitas"</h5>
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                    </div>
                </div>
                <div class="img-thumb text-center wow fadeInUp" data-wow-delay="0.6s">
                    <img class="img-fluid" src="{{ asset('/storage/pages/poster/'.$data->image) }}"
                        style="width:70%;height: auto;">
                </div>
            </div>
        </div>
    </div>
</div>


<div id="feature">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="text-wrapper">
                    <div>
                        <h2 class="title-hl wow fadeInLeft" data-wow-delay="0.3s">Tentang Kami</h2>
                        <p class="mb-4">{!! nl2br($data->content) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 feature-bg pt-5 pb-5 text-white">
                <div class="text-wrapper">
                    <div>
                        <h2 class="title-hl wow fadeInLeft text-white" data-wow-delay="0.3s">Tujuan</h2>
                        <p class="mb-4 text-white">{!! nl2br($data->content_extra) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Counter Section Start -->
<section id="counter" class="section-padding">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="row">
                    <!-- Start counter -->
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="counter-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="fact-count">
                                <h3><span class="counter">{{ $counter['alumni'] }}</span></h3>
                                <p>Alumni</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                    <!-- Start counter -->
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="counter-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="fact-count">
                                <h3><span class="counter">{{ $counter['patner'] }}</span></h3>
                                <p>Mitra</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                    <!-- Start counter -->
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="counter-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="fact-count">
                                <h3><span class="counter">{{ $counter['loker'] }}</span></h3>
                                <p>Lowongan Kerja</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter Section End -->
@endsection
