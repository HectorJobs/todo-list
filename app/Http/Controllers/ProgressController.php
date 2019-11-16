<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Progress;
use Auth;

class ProgressController extends Controller
{

    public function showView(){
        if(!Auth::user()) return redirect('/login');
        return view('leader.progress');
    }

    public function index(Request $request){
        $progress = Progress::all();
        return json_encode(["intRes" => 200, "jsonRes" => $progress]);
    }

    public function store(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $progress = new Progress($arrayReq);
            $progress->save();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }

    public function update(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $progress = Progress::find($arrayReq['id']);
            $progress->name = $arrayReq['name'];
            $progress->save();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }

    public function destroy(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $progress = Progress::find($arrayReq['id']);
            $progress->delete();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }
}
