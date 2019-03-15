@extends('layouts.authlayout')
@section('content')
<section class="section">
        <div class="columns">
            <div class="column">
                <h3 class="title is-3">Products 
                    <i class="mdi mdi-motorbike mdi-36px"></i>
                    <i class="mdi mdi-cellphone mdi-36px"></i>
                    <i class="mdi mdi-desktop-classic mdi-36px"></i>
                    <i class="mdi mdi-disc-player mdi-36px"></i>
                    <i class="mdi mdi-camera mdi-36px"></i>
                    <i class="mdi mdi-television-box mdi-36px"></i>
                    <i class="mdi mdi-gamepad-variant mdi-36px"></i>
                    <i class="mdi mdi-cctv mdi-36px"></i>
                </h3>
            </div>
            <div class="column">
                <a href="#" class="button is-white is-pulled-right"> </a>
            </div>
        </div>
<div class="box">
    <div class="columns is-multiline">
        <div class="column is-one-quarter">
            <a href="{{ route('products.autos') }}">
                <div class="box has-ribbon-bottom is-small">
                    <i class="mdi mdi-motorbike mdi-48px"></i>
                    <div class="ribbon is-medium is-link">Autos</div>
                </div>
            </a>
        </div>
        <div class="column is-one-quarter">
            <a href="{{ route('products.electronic') }}">
                <div class="box has-ribbon-bottom is-small">
                    <i class="mdi mdi-store mdi-48px"></i>
                    <div class="ribbon is-medium is-primary">Electronic</div>
                </div>
            </a>
        </div>
         
    </div>  
</div>
</section>
@endsection