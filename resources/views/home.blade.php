@extends('layouts.app')

@section('content')
    <main class="resume-body">
        <div class="contact-info alt-lyt">
            <h2>Personal information</h2>
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
        <section class="summary">
            <h2>Career Summary</h2>
            <p>
                {{ $basics["summary"] }}
            </p>
        </section>
        <section class="skills">
            <h2>Skills &amp; Technologies</h2>
            <ul>
                @foreach ($skills as $skill)
                    <li>{{ $skill["name"] }}</li>
                @endforeach
            </ul>
        </section>
        <section class="languages">
            <h2>Languages &amp; Tools</h2>
            <ul>
                @foreach ($skills as $skill)
                    @if (array_key_exists("keywords", $skill))
                        <li>{{ implode(", ", $skill["keywords"]) }}</li>
                    @endif
                @endforeach
            </ul>
        </section>
        <section class="work-xp">
            <h2>Work Experience</h2>
            <ul>
                @foreach ($work as $workXp)
                    @php
                        $startDate = strtotime($workXp["startDate"]);
                    @endphp
                    <li>
                        <div class="work-img">
                            <img src="{{ asset('storage/media/work-default.png') }}" alt="{{ $workXp["name"] }}">
                        </div>
                        <div class="work-info">
                            <h3 class="work-title">
                                {{ $workXp["position"] }}<span class="work-start-date">, {{ date('Y', $startDate) }}</span>
                            </h3>
                            <p class="work-location">{{ $workXp["location"] }}</p>
                        </div>
                        <div class="work-desc">
                            <ul>
                                @foreach ($workXp["highlights"] as $highlight)
                                    <li>
                                        <details>
                                            <summary class="work-position">
                                                {{ explode(":  ", $highlight)[0] }}
                                            </summary>
                                            <p>: {{ explode(":  ", $highlight)[1] }}</p>
                                        </details>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    </main>
@endsection
