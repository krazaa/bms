@extends('layouts.authlayout')
@section('content')
@include('layouts.error')
@include('layouts.success')
	<section class="section">
    <div class="box">
        {{-- <dashboard></dashboard> --}}
        <router-view></router-view>
        {{-- <users></users> --}}	
        {{-- <autocomplet></autocomplet> --}}
	</div>
</section>
@endsection