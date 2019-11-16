<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complexity;
use Auth;

class ComplexityController extends Controller
{
    public function showView(){
        if(!Auth::user()) return redirect('/login');
        return view('leader.complexity');
    }

    public function index(Request $request){
        $complexities = Complexity::all();
        return json_encode(["intRes" => 200, "jsonRes" => $complexities]);
    }

    public function store(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $complexity = new Complexity($arrayReq);
            $complexity->save();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }

    public function update(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $complexity = Complexity::find($arrayReq['id']);
            $complexity->name = $arrayReq['name'];
            $complexity->color = $arrayReq['color'];
            $complexity->save();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }

    public function destroy(Request $request){
        try{
            $arrayReq = json_decode($request->getContent(), true);
            $complexity = Complexity::find($arrayReq['id']);
            $complexity->delete();
            return json_encode(["intRes" => 200]);
        }catch(Exception $e){
            return json_encode(["intRes" => 500]);
        }
    }
}
