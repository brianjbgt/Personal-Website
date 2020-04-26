<?php

namespace App\Http\Controllers;

use App\Skill;
use App\User;
use App\Profile;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Profile $profile)
    {
        $skills = Profile::find($profile->id)->skills()->get(); 
        return view('skills.index',  compact('skills'))->with('i',0);
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store()
    {
        $data = request()->validate([
            'skill_desc' => 'required',
        ]);

        auth()->user()->profile->skills()->create($data);

        return redirect('/skills/' . auth()->user()->profile->id);
    }

    public function edit(Skill $skill)
    {
        $this->authorize('update', auth()->user()->profile);
        return view('skills.edit', compact('skill'));
    }

    public function update(Skill $skill)
    {
        $this->authorize('update', auth()->user()->profile);
        $data = request()->validate([
            'skill_desc' => 'required',
        ]);
 
        $skill->update($data);

        return redirect("/skills/" . auth()->user()->profile->id);
    }

    public function show(Skill $skill){
        return view('skills.show', compact('skill'));
    }

    public function delete(Skill $skill)
    {
        $skill->delete();

        return redirect("/skills/" . auth()->user()->profile->id);
    }    
}