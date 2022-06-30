@extends('layouts.app')

@section('content')
    <main class="form-body">
        <form action="{{ route('login') }}" method="POST">
            @if (session('status'))
                <div class="input-group">
                    <div class="error-msg">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            @csrf
            <div class="input-group @error('email') missing @enderror">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="Your email" value="{{ old('name') }}">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group @error('password') missing @enderror">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Choose a password">
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group inline">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <div class="input-group">
                <button type="submit">Log In</button>
            </div>
        </form>
    </main>
@endsection
