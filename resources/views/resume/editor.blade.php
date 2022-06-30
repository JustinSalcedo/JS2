@extends('layouts.app')

@section('content')
    <main class="form-body">
        <form action="" method="POST" class="resume-editor">
            @csrf
            <h2>Personal information</h2>
            <div class="res-basics-form">
                <div class="input-group @error('city') missing @enderror">
                    <label for="city" class="sr-only">City</label>
                    <input type="text" name="city" id="city" placeholder="Your city" @if (old('city'))
                        value="{{ old('city') }}"
                    @else
                        value="{{ $basics["location"]["city"] }}"
                    @endif>
                    @error('city')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group @error('region') missing @enderror">
                    <label for="region" class="sr-only">State</label>
                    <input type="text" name="region" id="region" placeholder="Your state" @if (old('region'))
                    value="{{ old('region') }}"
                @else
                    value="{{ $basics["location"]["region"] }}"
                @endif>
                    @error('region')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group @error('email') missing @enderror">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="Your email" @if (old('email'))
                    value="{{ old('email') }}"
                @else
                    value="{{ $basics["email"] }}"
                @endif>
                    @error('email')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="res-profiles-form">
                @foreach ($basics["profiles"] as $profile)
                    @php
                        $net = strtolower($profile["network"]);
                    @endphp
                    <div class="input-group @error($net) missing @enderror">
                        <label for="{{ $net }}" class="sr-only">{{ $profile["network"] }}</label>
                        <input type="url" name="{{ $net }}" id="{{ $net }}" placeholder="" @if (old($net))
                        value="{{ old($net) }}"
                    @else
                        value="{{ $profile["url"] }}"
                    @endif>
                        @error($net)
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            <h2>Career Summary</h2>
            <div class="input-group res-summary-form @error('summary') missing @enderror">
                <label for="summary" class="sr-only">Summary</label>
                @php
                    $prevSummary = "";
                    if (old('summary')) $prevSummary = old('summary');
                    else $prevSummary = $basics["summary"];
                @endphp
                <textarea name="summary" id="summary" cols="30" rows="4" placeholder="Post something!">{{ $prevSummary }}</textarea>
                @error('summary')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <h2>Skills + Languages</h2>
            <div class="skillAndLang-container">
                @for ($i = 0; $i < count($skills); $i++)
                    <div class="skillAndLangForm">
                        <div class="input-group @error('skill_'.$i) missing @enderror">
                            <label for="skill_{{ $i }}" class="sr-only">Skill <button class="skill-up">🔺</button><button class="skill-down">🔻</button><button class="skill-del">🗑️</button></label>
                            <input type="text" name="skill_{{ $i }}" id="skill_{{ $i }}" @if (old('skill_'.$i))
                                value="{{ old('skill_'.$i) }}"
                            @else
                                value="{{ $skills[$i]["name"] }}"
                            @endif>
                            @error('skill_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('lang_'.$i) missing @enderror">
                            <label for="lang_{{ $i }}" class="sr-only">Languages</label>
                            <input type="text" name="lang_{{ $i }}" id="lang_{{ $i }}" @if (old('lang_'.$i))
                                value="{{ old('lang_'.$i) }}"
                            @elseif (array_key_exists("keywords", $skills[$i]))
                                value="{{ implode(", ", $skills[$i]["keywords"]) }}"
                            @endif>
                            @error('lang_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endfor
            </div>
            <div class="add-skill">
                <button>➕</button>
            </div>

            <h2>Work Experience</h2>
            <div class="work-form-container">
                @for ($i = 0; $i < count($work); $i++)
                    <div class="work-form">
                        <div class="input-group @error('workName_'.$i) missing @enderror">
                            <label for="workName_{{ $i }}" class="sr-only">Name <button class="work-up">🔺</button><button class="work-down">🔻</button><button class="work-del">🗑️</button></label>
                            <input type="text" name="workName_{{ $i }}" id="workName_{{ $i }}" @if (old('workName_'.$i))
                                value="{{ old('workName_'.$i) }}"
                            @else
                                value="{{ $work[$i]["name"] }}"
                            @endif>
                            @error('workName_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('workPos_'.$i) missing @enderror">
                            <label for="workPos_{{ $i }}" class="sr-only">Position</label>
                            <input type="text" name="workPos_{{ $i }}" id="workPos_{{ $i }}" @if (old('workPos_'.$i))
                                value="{{ old('workPos_'.$i) }}"
                            @else
                                value="{{ $work[$i]["position"] }}"
                            @endif>
                            @error('workPos_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('workLoc_'.$i) missing @enderror">
                            <label for="workLoc_{{ $i }}" class="sr-only">Location</label>
                            <input type="text" name="workLoc_{{ $i }}" id="workLoc_{{ $i }}" @if (old('workLoc_'.$i))
                                value="{{ old('workLoc_'.$i) }}"
                            @else
                                value="{{ $work[$i]["location"] }}"
                            @endif>
                            @error('workLoc_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('workStrtDate_'.$i) missing @enderror">
                            <label for="workStrtDate_{{ $i }}" class="sr-only">Start date</label>
                            <input type="date" name="workStrtDate_{{ $i }}" id="workStrtDate_{{ $i }}" @if (old('workStrtDate_'.$i))
                                value="{{ old('workStrtDate_'.$i) }}"
                            @else
                                value="{{ $work[$i]["startDate"] }}"
                            @endif>
                            @error('workStrtDate_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('workEndDate_'.$i) missing @enderror">
                            <label for="workEndDate_{{ $i }}" class="sr-only">End date</label>
                            <input type="date" name="workEndDate_{{ $i }}" id="workEndDate_{{ $i }}" @if (old('workEndDate_'.$i))
                                value="{{ old('workEndDate_'.$i) }}"
                            @else
                                value="{{ $work[$i]["endDate"] }}"
                            @endif>
                            @error('workEndDate_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group @error('workHi_'.$i) missing @enderror">
                            <label for="workHi_{{ $i }}" class="sr-only">Highlights</label>
                            @php
                                $prevHigh = "";
                                if (old('workHi_'.$i)) $prevHigh = old('workHi_'.$i);
                                else $prevHigh = implode("\n", $work[$i]["highlights"]);
                            @endphp
                            <textarea name="workHi_{{ $i }}" id="workHi_{{ $i }}" cols="30" rows="4" placeholder="Post something!">{{ $prevHigh }}</textarea>
                            @error('workHi_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endfor
            </div>
            <div class="add-work">
                <button>➕</button>
            </div>

            <div class="input-group">
                <button type="submit">Save resume</button>
            </div>
        </form>
    </main>
@endsection
