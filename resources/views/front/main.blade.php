@extends('front.layouts.master')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center" data-aos="zoom-in" data-aos-delay="100">
        <h1>{{$abouts->name}}</h1>
        <h2>I'm a professional illustrator from San Francisco</h2>
        <a href="{{route('front.about')}}" class="btn-about">Haqqimda</a>
    </div>
</section><!-- End Hero -->


@endsection
