<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Profile;
use App\Http\Requests\EducationRequest;
use App\Education;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Profile $profile){
        return view('education.index', compact('profile'));
    }

    public function get(Profile $profile){

        return $profile->educations->toJson();
    }

    public function store(EducationRequest $request, Profile $profile){
        $EducationObj = new Education;
        // $EducationObj->title = $request->input('title');
        $EducationObj->institution = $request->input('institution');
        $EducationObj->address = $request->input('address');
        $EducationObj->program =  $request->input('program');
        $EducationObj->period = $request->input('period');
        $EducationObj->achievement =$request->input('achievement');
        $EducationObj->prof_id = $profile->id;
        $EducationObj->save();


        return response()->json(['message'=>'success']);
    }

    public function update(EducationRequest $request, Education $education){
        // $education->title = $request->input('title');
        $education->institution = $request->input('institution');
        $education->address = $request->input('address');
        $education->program =  $request->input('program');
        $education->period = $request->input('period');
        $education->achievement =$request->input('achievement');
        $education->save();

        return response()->json(['message'=>'success']);
    }


    public function delete(Education $education){
        $education->delete();

        return response()->json(['message' => 'Successfully Deleted Entry: '.$education->institution]);
    }
}
