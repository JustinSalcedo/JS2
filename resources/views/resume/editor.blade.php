@extends('layouts.app')

@section('content')
    <main class="form-body">
        <form action="" method="POST" class="resume-editor" enctype="multipart/form-data">
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
                        <div class="input-group @error('workSumm_'.$i) missing @enderror">
                            <label for="workSumm_{{ $i }}" class="sr-only">Summary</label>
                            <input type="text" name="workSumm_{{ $i }}" id="workSumm_{{ $i }}" @if (old('workSumm_'.$i))
                                value="{{ old('workSumm_'.$i) }}"
                            @else
                                value="{{ $work[$i]["summary"] }}"
                            @endif>
                            @error('workSumm_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('workUrl_'.$i) missing @enderror">
                            <label for="workUrl_{{ $i }}" class="sr-only">URL</label>
                            <input type="url" name="workUrl_{{ $i }}" id="workUrl_{{ $i }}" @if (old('workUrl_'.$i))
                                value="{{ old('workUrl_'.$i) }}"
                            @else
                                value="{{ $work[$i]["url"] }}"
                            @endif>
                            @error('workUrl_'.$i)
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
                        <div class="work-timg-field">
                            @if (array_key_exists("thumbnail", $work[$i]))
                                <input type="hidden" name="workOlTimg_{{ $i }}" id="workOlTimg_{{ $i }}"
                                    value="{{ $work[$i]["thumbnail"] }}">
                                <div class="timg-preview">
                                    <img src="{{ asset($work[$i]["thumbnail"]) }}" alt="thumbnail">
                                </div>
                                <button class="work-add-timg">🖼️ Replace this thumbnail</button>
                            @else
                                <button class="work-add-timg">🖼️ Add a thumbnail (optional)</button>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
            <div class="add-work">
                <button>➕</button>
            </div>

            <h2>Portfolio</h2>
            <div class="proj-form-container">
                @for ($i = 0; $i < count($projects); $i++)
                    <div class="proj-form">
                        <div class="input-group @error('projName_'.$i) missing @enderror">
                            <label for="projName_{{ $i }}" class="sr-only">Name <button class="proj-up">🔺</button><button class="proj-down">🔻</button><button class="proj-del">🗑️</button></label>
                            <input type="text" name="projName_{{ $i }}" id="projName_{{ $i }}" @if (old('projName_'.$i))
                                value="{{ old('projName_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["name"] }}"
                            @endif>
                            @error('projName_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projEnt_'.$i) missing @enderror">
                            <label for="projEnt_{{ $i }}" class="sr-only">Entity</label>
                            <input type="text" name="projEnt_{{ $i }}" id="projEnt_{{ $i }}" @if (old('projEnt_'.$i))
                                value="{{ old('projEnt_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["entity"] }}"
                            @endif>
                            @error('projEnt_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projType_'.$i) missing @enderror">
                            <label for="projType_{{ $i }}" class="sr-only">Type</label>
                            <input type="text" name="projType_{{ $i }}" id="projType_{{ $i }}" @if (old('projType_'.$i))
                                value="{{ old('projType_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["type"] }}"
                            @endif>
                            @error('projType_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projStrtDate_'.$i) missing @enderror">
                            <label for="projStrtDate_{{ $i }}" class="sr-only">Start date</label>
                            <input type="date" name="projStrtDate_{{ $i }}" id="projStrtDate_{{ $i }}" @if (old('projStrtDate_'.$i))
                                value="{{ old('projStrtDate_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["startDate"] }}"
                            @endif>
                            @error('projStrtDate_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projEndDate_'.$i) missing @enderror">
                            <label for="projEndDate_{{ $i }}" class="sr-only">End date</label>
                            <input type="date" name="projEndDate_{{ $i }}" id="projEndDate_{{ $i }}" @if (old('projEndDate_'.$i))
                                value="{{ old('projEndDate_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["endDate"] }}"
                            @endif>
                            @error('projEndDate_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projRoles_'.$i) missing @enderror">
                            <label for="projRoles_{{ $i }}" class="sr-only">Roles</label>
                            @php
                                $prevRoles = "";
                                if (old('projRoles_'.$i)) $prevRoles = old('projRoles_'.$i);
                                else $prevRoles = implode(", ", $projects[$i]["roles"]);
                            @endphp
                            <input type="text" name="projRoles_{{ $i }}" id="projRoles_{{ $i }}" value="{{ $prevRoles }}" >
                            @error('projRoles_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projUrl_'.$i) missing @enderror">
                            <label for="projUrl_{{ $i }}" class="sr-only">URL</label>
                            <input type="url" name="projUrl_{{ $i }}" id="projUrl_{{ $i }}" @if (old('projUrl_'.$i))
                                value="{{ old('projUrl_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["url"] }}"
                            @endif>
                            @error('projUrl_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projDesc_'.$i) missing @enderror">
                            <label for="projDesc_{{ $i }}" class="sr-only">Description</label>
                            <input type="text" name="projDesc_{{ $i }}" id="projDesc_{{ $i }}" @if (old('projDesc_'.$i))
                                value="{{ old('projDesc_'.$i) }}"
                            @else
                                value="{{ $projects[$i]["description"] }}"
                            @endif>
                            @error('projDesc_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group @error('projHi_'.$i) missing @enderror">
                            <label for="projHi_{{ $i }}" class="sr-only">Highlights</label>
                            @php
                                $prevHigh = "";
                                if (old('projHi_'.$i)) $prevHigh = old('projHi_'.$i);
                                else $prevHigh = implode("\n", $projects[$i]["highlights"]);
                            @endphp
                            <textarea name="projHi_{{ $i }}" id="projHi_{{ $i }}" cols="30" rows="4" placeholder="Post something!">{{ $prevHigh }}</textarea>
                            @error('projHi_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group @error('projKeys_'.$i) missing @enderror">
                            <label for="projKeys_{{ $i }}" class="sr-only">Keywords</label>
                            @php
                                $prevKeys = "";
                                if (old('projKeys_'.$i)) $prevKeys = old('projKeys_'.$i);
                                else $prevKeys = implode(", ", $projects[$i]["keywords"]);
                            @endphp
                            <input type="text" name="projKeys_{{ $i }}" id="projKeys_{{ $i }}" value="{{ $prevKeys }}" >
                            @error('projKeys_'.$i)
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="proj-timg-field">
                            @if (array_key_exists("thumbnail", $projects[$i]))
                                <input type="hidden" name="projOlTimg_{{ $i }}" id="projOlTimg_{{ $i }}"
                                    value="{{ $projects[$i]["thumbnail"] }}">
                                <div class="timg-preview">
                                    <img src="{{ asset($projects[$i]["thumbnail"]) }}" alt="thumbnail">
                                </div>
                                <button class="proj-add-timg">🖼️ Replace this thumbnail</button>
                            @else
                                <button class="proj-add-timg">🖼️ Add a thumbnail (optional)</button>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
            <div class="add-project">
                <button>➕</button>
            </div>

            <div class="input-group">
                <button type="submit">Save resume</button>
            </div>
        </form>
    </main>
@endsection
