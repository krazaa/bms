@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-12">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Dashboard
                        </p>
                    </header>
                    {{-- <example></example-component> --}}
                    <div class="card-content">
                        You are logged in!
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
