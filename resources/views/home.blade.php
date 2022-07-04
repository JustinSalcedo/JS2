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
                            <a href="{{ $workXp["url"] }}">
                                <img @if (array_key_exists("thumbnail", $workXp))
                                        src="{{ asset($workXp["thumbnail"]) }}"
                                    @else
                                        src="{{ asset('storage/media/work-default.png') }}"
                                @endif alt="{{ $workXp["name"] }}">
                            </a>
                        </div>
                        <div class="work-info">
                            <h3 class="work-title">
                                {{ $workXp["position"] }}<span class="work-start-date">, {{ date('Y', $startDate) }}</span>
                            </h3>
                            <p class="work-location"><a href="{{ $workXp["url"] }}">{{ $workXp["name"] }}</a> | <i>{{ $workXp["location"] }}</i></p>
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
        <section class="projects" id="portfolio">
            <h2>Projects</h2>
            <ul>
                @php
                    usort($projects, function ($a, $b) {
                        return $a["startDate"] < $b["startDate"];
                    });

                    function removeSpecialChar($str) {
                        return preg_replace('/[^a-zA-Z0-9_-]/s', '', strtolower($str));
                    }
                @endphp
                @foreach ($projects as $project)
                    <li>
                        <div class="proj-img">
                            <a href="{{ $project["url"] }}">
                                <img @if (array_key_exists("thumbnail", $project))
                                        src="{{ asset($project["thumbnail"]) }}"
                                    @else
                                        src="{{ asset('storage/media/proj-default.png') }}"
                                @endif alt="{{ $project["name"] }}">
                            </a>
                        </div>
                        <div class="proj-info">
                            <h3 class="proj-title">
                                <a href="{{ $project["url"] }}">{{ $project["name"] }}</a>
                                <span class="proj-type">{{ $project["type"] }}</span>
                            </h3>
                            <p class="proj-subtitle">{{ $project["description"] }}</p>
                        </div>
                        @php
                            $tagSet = array_slice($project["keywords"], 0, 3);
                        @endphp
                        <ul class="proj-tags">
                            @foreach ($tagSet as $tag)
                                @php
                                    $bagClass = removeSpecialChar($tag);
                                @endphp
                                <li>{{ $bagClass }}</li>
                            @endforeach
                        </ul>
                        <div class="proj-desc">
                            <details>
                                <summary></summary>
                                <div class="proj-desc-body">
                                    <ul>
                                        @foreach ($project["highlights"] as $highlight)
                                            <li><p>{{ $highlight }}</p></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </details>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    </main>
@endsection
