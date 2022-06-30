@extends('layouts.app')

@section('content')
    <main class="form-body">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group @error('name') missing @enderror">
                <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" placeholder="Your name" value="{{ old('name') }}">
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group @error('username') missing @enderror">
                <label for="username" class="sr-only">Userame</label>
                <input type="text" name="username" id="username" placeholder="Username" value="{{ old('name') }}">
                @error('username')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
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
            <div class="input-group @error('password_confirmation') missing @enderror">
                <label for="password_confirmation" class="sr-only">Password again</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password">
                @error('password_confirmation')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <button type="submit">Sign Up</button>
            </div>
        </form>
    </main>
@endsection
