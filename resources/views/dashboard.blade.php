@extends('layouts.app')

@section('content')
    <main class="resume-body">
        Dashboard
        <div>You are {{ auth()->user()->name }}</div>
    </main>
@endsection
