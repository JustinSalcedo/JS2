<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justin Salcedo - Web Developer</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/badges.css') }}">
</head>
<body>
    @php
        $resume = App\Http\Controllers\Resume\ResumeController::read();
        $basics = $resume["basics"]
    @endphp
    <div class="blackout off"></div>
    <div class="preloader" style="
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: hsla(260, 20%, 5%, 0.4);
        z-index: 1;
    "></div>
    <section class="nav-bar">
        <header>
            <a href="{{ route('home') }}">
                <h1>
                    <span class="author-name">Justin Salcedo</span>
                    <span class="author-role">Web Developer</span>
                </h1>
            </a>
            </header>
        <div class="contact-info alt-lyt">
            <div class="contact-links">
                <div class="contact-method">
                    <!-- <div class="icon icon-pin"></div> -->
                    📍 {{ $basics["location"]["city"] }}, {{ $basics["location"]["region"] }}. {{ $basics["location"]["countryCode"] }}
                </div>
                <div class="contact-method">
                    <!-- <span class="contact-icon"></span> -->
                    ✉️ <a href="mailto:{{ $basics["email"] }}">{{ $basics["email"] }}</a>
                </div>
            </div>
            <ul class="social-links">
                <li><a href="{{ $basics["profiles"][0]["url"] }}">
                    <img src="{{ asset('storage/media/github.svg') }}" alt="{{ $basics["profiles"][0]["network"] }}">
                </a></li>
                <li><a href="{{ $basics["profiles"][1]["url"] }}">
                    <img src="{{ asset('storage/media/twitter.svg') }}" alt="{{ $basics["profiles"][1]["network"] }}">
                </a></li>
                <li><a href="{{ $basics["profiles"][2]["url"] }}">
                    <img src="{{ asset('storage/media/linkedin.svg') }}" alt="{{ $basics["profiles"][2]["network"] }}">
                </a></li>
            </ul>
        </div>
        <div class="access-opts">
            <button class="icon-theme switch-theme">🌙</button>
            <select name="language" id="language">
                <option value="en">en</option>
            </select>
        </div>
        <button class="nav-burger">
            <div class="burger-loaf"></div>
            <div class="burger-loaf"></div>
            <div class="burger-loaf"></div>
        </button>
        <nav class="nav-content">
            <ul>
                <li class="access-opts">
                    <button id="go-hide" class="icon-hide">⬅️</button>
                    <button id="go-home" class="icon-home"><a href="{{ route('home') }}">🏠</a></button>
                    <button class="icon-theme switch-theme">🌙</button>
                    <select name="language" id="language">
                        <option value="en">en</option>
                    </select>
                </li>
                {{-- <li><a href="index.html#portfolio">Portfolio</a></li> --}}
                {{-- <li><a href="{{ route('blog') }}">Blog</a></li> --}}
                {{-- <li><a href="workshop.html">Workshop</a></li> --}}
                {{-- <li><a href="privacy-policy.html">Privacy Policy</a></li> --}}
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                    @can('edit-resume')
                        <li><a href="{{ route('resume.editor') }}">Edit Resume</a></li>
                    @endcan
                @endauth

                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                @endguest
                <li class="nav-footer">
                    <div class="contact-info">
                        <div class="contact-links">
                            <div class="contact-method">
                                📍 {{ $basics["location"]["city"] }}, {{ $basics["location"]["region"] }}. {{ $basics["location"]["countryCode"] }}
                            </div>
                            <div class="contact-method">
                                ✉️ <a href="mailto:{{ $basics["email"] }}">{{ $basics["email"] }}</a>
                            </div>
                        </div>
                        <ul class="social-links">
                            <li><a href="{{ $basics["profiles"][0]["url"] }}">
                                <img src="{{ asset('storage/media/github.svg') }}" alt="{{ $basics["profiles"][0]["network"] }}">
                            </a></li>
                            <li><a href="{{ $basics["profiles"][1]["url"] }}">
                                <img src="{{ asset('storage/media/twitter.svg') }}" alt="{{ $basics["profiles"][1]["network"] }}">
                            </a></li>
                            <li><a href="{{ $basics["profiles"][2]["url"] }}">
                                <img src="{{ asset('storage/media/linkedin.svg') }}" alt="{{ $basics["profiles"][2]["network"] }}">
                            </a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </section>
    @yield('content')
    <footer>
        <div class="contact-info">
            <div class="contact-links">
                <div class="contact-method">
                    📍 {{ $basics["location"]["city"] }}, {{ $basics["location"]["region"] }}. {{ $basics["location"]["countryCode"] }}
                </div>
                <div class="contact-method">
                    ✉️ <a href="mailto:{{ $basics["email"] }}">{{ $basics["email"] }}</a>
                </div>
            </div>
            <ul class="social-links">
                <li><a href="{{ $basics["profiles"][0]["url"] }}">
                    <img src="{{ asset('storage/media/github-white.svg') }}" alt="{{ $basics["profiles"][0]["network"] }}">
                </a></li>
                <li><a href="{{ $basics["profiles"][1]["url"] }}">
                    <img src="{{ asset('storage/media/twitter-white.svg') }}" alt="{{ $basics["profiles"][1]["network"] }}">
                </a></li>
                <li><a href="{{ $basics["profiles"][2]["url"] }}">
                    <img src="{{ asset('storage/media/linkedin-white.svg') }}" alt="{{ $basics["profiles"][2]["network"] }}">
                </a></li>
            </ul>
        </div>
        <div class="footer-links">
            {{-- <ul>
                <li><a href="">Privacy Policy</a></li>
            </ul> --}}
            <br />
        </div>
        <p class="copy-notice">
            &copy; 2022. All rights reserved.
        </p>
        <div class="top-scroll">⬆️</div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
