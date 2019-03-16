@extends('layouts.authlayout')
@section('content')
@include('layouts.error')
@include('layouts.success')
<section class="section">
    <div class="box">
        <editbranch branchid="{{ $id }}"></editbranch>
        </div>
@endsection