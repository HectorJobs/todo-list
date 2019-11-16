<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use App\User;
use App\Complexity;
use App\Progress;
use Auth;

class WorkController extends Controller
{
    public function index(Request $request){
        $works = Work::all();
        $works->each(function($work){
            $work->user;
            $work->progress;
            $work->complexity;
        });
        $users = User::all();
        $complexities = Complexity::all();
        $progress = Progress::all();
        return json_encode([
            "intRes" => 200, 
            "arrayWorks" => $works, 
            "arrayUsers" => $users,
            "arrayComplexities" => $complexities,
            "arrayProgress" => $progress
        ]);
    }

    public function store(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $work = new Work($arrayReq);
            $work->save();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }

    public function update(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $work = Work::find($arrayReq['id']);
            $work->user_id = $arrayReq['user_id'];
            $work->progress_id = $arrayReq['progress_id'];
            $work->complexity_id = $arrayReq['complexity_id'];
            $work->name = $arrayReq['name'];
            $work->description = $arrayReq['description'];
            $work->time = $arrayReq['time'];
            $work->dead_line = $arrayReq['dead_line'];
            $work->save();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }
}
