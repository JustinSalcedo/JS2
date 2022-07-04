<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
            'languages' => $resume["languages"],
            'projects' => $resume["projects"]
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
            $workValidation["workSumm_".$w] = "required|max:255";
            $workValidation["workUrl_".$w] = "required|url";
            $workValidation["workHi_".$w] = "required";
            $w++;
        }

        $p = 0; $projValidation = [];
        while (array_key_exists("projName_".$p, $request->all())) {
            $projValidation["projName_".$p] = "required|max:255";
            $projValidation["projEnt_".$p] = "required|max:255";
            $projValidation["projType_".$p] = "required|max:255";
            $projValidation["projStrtDate_".$p] = "required|date";
            $projValidation["projEndDate_".$p] = "date";
            $projValidation["projRoles_".$p] = "required";
            $projValidation["projUrl_".$p] = "required|url";
            $projValidation["projDesc_".$p] = "required|max:255";
            $projValidation["projHi_".$p] = "required";
            $projValidation["projKeys_".$p] = "required";
            $p++;
        }

        $this->validate($request, array_merge($skillValidation, $workValidation, $projValidation));
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
                'summary' => $request->all()["workSumm_".$w],
                'url' => $request->all()["workUrl_".$w],
                'highlights' => explode("\n", $request->all()["workHi_".$w])
            ];
            if (array_key_exists("workEndDate_".$w, $request->all())) {
                $workXp["endDate"] = $request->all()["workEndDate_".$w];
            }

            if (array_key_exists("workTimg_".$w, $request->all())) {
                $path = $request->file("workTimg_".$w)->store('public/media/wtimgs');
                $workXp["thumbnail"] = Storage::url($path);

            } else if (array_key_exists("workOlTimg_".$w, $request->all())) {
                $workXp["thumbnail"] = $request->all()["workOlTimg_".$w];
            }

            array_push($workHist, $workXp);
            $w++;
        }

        $this->deleteTimgs($workHist, $resume["work"]);

        $resume["work"] = $workHist;

        $p = 0; $portfolio = [];
        while (array_key_exists("projName_".$p, $request->all())) {
            $project = [
                'name' => $request->all()["projName_".$p],
                'entity' => $request->all()["projEnt_".$p],
                'type' => $request->all()["projType_".$p],
                'startDate' => $request->all()["projStrtDate_".$p],
                'roles' => explode(", ", $request->all()["projRoles_".$p]),
                'url' => $request->all()["projUrl_".$p],
                'description' => $request->all()["projDesc_".$p],
                'highlights' => explode("\n", $request->all()["projHi_".$p]),
                'keywords' => explode(", ", $request->all()["projKeys_".$p])
            ];
            if (array_key_exists("projEndDate_".$p, $request->all())) {
                $project["endDate"] = $request->all()["projEndDate_".$p];
            }

            if (array_key_exists("projTimg_".$p, $request->all())) {
                $path = $request->file("projTimg_".$p)->store('public/media/ptimgs');
                $project["thumbnail"] = Storage::url($path);

            } else if (array_key_exists("projOlTimg_".$p, $request->all())) {
                $project["thumbnail"] = $request->all()["projOlTimg_".$p];
            }

            array_push($portfolio, $project);
            $p++;
        }

        $this->deleteTimgs($portfolio, $resume["projects"]);

        $resume["projects"] = $portfolio;

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
            'languages' => $resume["languages"],
            'projects' => $resume["projects"]
        ]);
    }

    private function deleteTimgs($newList, $oldList)
    {
        $newWithTimgs = array_filter($newList, function ($item) {
            return array_key_exists("thumbnail", $item);
        });
        $currTimgPaths = array_map(function ($item) {
            return $item["thumbnail"];
        }, $newWithTimgs);

        $oldWithTimgs = array_filter($oldList, function ($item) {
            return array_key_exists("thumbnail", $item);
        });
        $oldTimgPaths = array_map(function ($item) {
            return $item["thumbnail"];
        }, $oldWithTimgs);

        $i = 0; $expiredTimgPaths = [];
        while($i < count($oldTimgPaths)) {
            $j = 0; $isExpired = true;
            while($j < count($currTimgPaths)) {
                if ($oldTimgPaths[$i] === $currTimgPaths[$j]) {
                    $isExpired = false;
                    break;
                }
                $j++;
            }
            if ($isExpired) {
                array_push($expiredTimgPaths, $oldTimgPaths[$i]);
            }
            $i++;
        }

        $parsedPaths = array_map(function ($timgPath) {
            return str_replace("/storage", "public", $timgPath);
        }, $expiredTimgPaths);

        return Storage::delete($parsedPaths);
    }
}
