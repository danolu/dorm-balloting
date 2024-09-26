<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ballot;
use App\Models\Spcan;

class HomeController extends Controller
{
    public function index() {
        return view('index');
    }

    public function submit(Request $request) {
    
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'matric' => 'required|numeric|confirmed',
            'sex' => 'required|string',
            'level' => 'required|string',
        ]);

        $balloted = Ballot::where('matric', $request->matric)->first();

        if ($balloted) {
            if ($balloted->response === 'yes') {
                $response = "Hi, ".$balloted->first_name.". You have already balloted, and you secured accommodation within the hall for this session.";
                return back()->with('success', $response);
            } else {
                $response = "Hi, ".$balloted->first_name.". You have already balloted, but you could not secure accommodation due to limited space.";
                return back()->with('alert', $response);
            }
        }

        $spcan = Spcan::where('matric', $request->matric)->first();

        if($spcan) {
            $ballot = new Ballot();
            $ballot->first_name = $request->first_name;
            $ballot->last_name = $request->last_name;
            $ballot->matric = $request->matric;
            $ballot->sex = $request->sex;
            $ballot->level = $request->level;
            $ballot->response = "yes";
            $ballot->spcan = true;
            $ballot->save();
            $response = "Congratulations, ".$ballot->first_name.". You have secured accommodation in the hall for this session.";
            return back()->with('success', $response);
        }

        $male_rooms = Ballot::where('sex', 'male')->where('response', 'yes')->where('spcan', false)->get()->count();

        $female_rooms = Ballot::where('sex', 'male')->where('response', 'yes')->where('spcan', false)->get()->count();

        $male_room_available;

        if((2 - $male_rooms) > 0) {
            $male_room_available = true;
        } else {
            $male_room_available = false;
        }

        $female_room_available;

        if((44 - $female_rooms) > 0) {
            $female_room_available = true;
        } else {
            $female_room_available = false;
        }

        if ($request->sex === 'male') {
            $ballot = new Ballot();
            $ballot->first_name = $request->first_name;
            $ballot->last_name = $request->last_name;
            $ballot->matric = $request->matric;
            $ballot->sex = $request->sex;
            $ballot->level = $request->level;
            $ballot->spcan = false;
            if ($male_room_available) {
                $ballot->response = array("yes", "no")[random_int(0,1)];
                $ballot->save();
                if ($ballot->response === "yes") {
                    $response = "Congratulations, ".$ballot->first_name.". You have secured accommodation in the hall for this session.";
                    return back()->with('success', $response);
                } else {
                    $response = "Hello, ".$ballot->first_name.". We are sorry we cannot offer you accommodation at this time due to limited spaces.";
                    return back()->with('success', $response);
                }
            } else {
                $ballot->response = "no";
                $ballot->save();
                $response = "Hello, ".$ballot->first_name.". We are sorry we cannot offer you accommodation at this time due to limited spaces.";
                return back()->with('success', $response);
            }
        } elseif ($request->sex === 'female') {
            $ballot = new Ballot();
            $ballot->first_name = $request->first_name;
            $ballot->last_name = $request->last_name;
            $ballot->matric = $request->matric;
            $ballot->sex = $request->sex;
            $ballot->level = $request->level;
            $ballot->spcan = false;
            if ($female_room_available) {
                $ballot->response = array("yes", "no")[random_int(0,1)];
                $ballot->save();
                if ($ballot->response === "yes") {
                    $response = "Congratulations, ".$ballot->first_name.". You have secured accommodation in the hall for this session.";
                    return back()->with('success', $response);
                } else {
                    $response = "Hello, ".$ballot->first_name.". We are sorry we cannot offer you accommodation at this time due to limited spaces.";
                    return back()->with('success', $response);
                }
            } else {
                $ballot->response = "no";
                $ballot->save();
                $response = "Hello, ".$ballot->first_name.". We are sorry we cannot offer you accommodation at this time due to limited spaces.";
                return back()->with('success', $response);
            }
        }
    }
}
