<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResumeController extends Controller
{
    public function index()
    {
        $resume = $this->read();

        return view('home', [
            'basics' => $resume["basics"],
            'work' => $resume["work"],
            'education' => $resume["education"],
            'awards' => $resume["awards"],
            'certificates' => $resume["certificates"],
            'skills' => $resume["skills"],
            'languages' => $resume["languages"]
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('edit-resume');

        $this->validate($request, [
            'city' => 'required|max:255',
            'region' => 'required|max:255',
            'email' => 'required|email|max:255',
            'github' => 'required|url',
            'twitter' => 'required|url',
            'linkedin' => 'required|url',
            'summary' => 'required'
        ]);

        $k = 0; $skillValidation = [];
        while (array_key_exists("skill_".$k, $request->all())) {
            $skillValidation["skill_".$k] = "required|max:255";
            $skillValidation["lang_".$k] = "max:255";
            $k++;
        }

        $w = 0; $workValidation = [];
        while (array_key_exists("workName_".$w, $request->all())) {
            $workValidation["workName_".$w] = "required|max:255";
            $workValidation["workPos_".$w] = "required|max:255";
            $workValidation["workLoc_".$w] = "required|max:255";
            $workValidation["workStrtDate_".$w] = "required|date";
            $workValidation["workEndDate_".$w] = "date";
            $workValidation["workHi_".$w] = "required";
            $w++;
        }

        $this->validate($request, array_merge($skillValidation, $workValidation));
        // dd('ok');

        // replace part of the JSON with the new Data

        $resume = $this->read();
        $resume["basics"]["location"]["city"] = $request->city;
        $resume["basics"]["location"]["region"] = $request->region;
        $resume["basics"]["email"] = $request->email;
        foreach ($resume["basics"]["profiles"] as $key => $profile) {
            $networkKey = strtolower($profile["network"]);
            $resume["basics"]["profiles"][$key]["url"] = $request->$networkKey;
        }
        $resume["basics"]["summary"] = $request->summary;

        $k = 0; $skillSet = [];
        while (array_key_exists("skill_".$k, $request->all())) {
            $skill = [
                'name' => $request->all()["skill_".$k]
            ];
            if (array_key_exists("lang_".$k, $request->all()) && $request->all()["lang_".$k]) {
                $skill["keywords"] = explode(", ", $request->all()["lang_".$k]);
            }
            array_push($skillSet, $skill);
            $k++;
        }
        $resume["skills"] = $skillSet;

        $w = 0; $workHist = [];
        while (array_key_exists("workName_".$w, $request->all())) {
            $workXp = [
                'name' => $request->all()["workName_".$w],
                'position' => $request->all()["workPos_".$w],
                'location' => $request->all()["workLoc_".$w],
                'startDate' => $request->all()["workStrtDate_".$w],
                'highlights' => explode("\n", $request->all()["workHi_".$w])
            ];
            if (array_key_exists("workEndDate_".$w, $request->all())) {
                $workXp["endDate"] = $request->all()["workEndDate_".$w];
            }
            array_push($workHist, $workXp);
            $w++;
        }
        $resume["work"] = $workHist;

        // dd($resume);

        $resumeJSON = json_encode($resume);
        file_put_contents(__DIR__."/masterResume.json", $resumeJSON);

        return redirect()->route('home');
    }

    public function read()
    {
        $resumeJSON = file_get_contents(__DIR__."/masterResume.json");
        return json_decode($resumeJSON, true);
    }

    public function modify()
    {
        Gate::authorize('edit-resume');

        $resume = $this->read();

        return view('resume.editor', [
            'basics' => $resume["basics"],
            'work' => $resume["work"],
            'education' => $resume["education"],
            'awards' => $resume["awards"],
            'certificates' => $resume["certificates"],
            'skills' => $resume["skills"],
            'languages' => $resume["languages"]
        ]);
    }
}
