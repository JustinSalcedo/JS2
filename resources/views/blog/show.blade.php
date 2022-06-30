@extends('layouts.app')

@section('content')
    <main class="resume-body">
        <x-post :post="$entry" />
    </main>
@endsection
