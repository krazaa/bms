@extends('layouts.authlayout')
@section('content')
@include('layouts.error')
@include('layouts.success')
	<section class="section">
    <div class="box">
        {{-- <autocomplet></autocomplet> --}}
        {{-- <dashboard></dashboard> --}}
        <router-view></router-view>
        {{-- <users></users> --}}	
	</div>
</section>
@endsection