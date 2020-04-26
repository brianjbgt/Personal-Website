<?php

namespace App\Http\Controllers;

Use App\User;
Use App\Profile;
Use App\Skill;
Use App\Work;
Use App\Work_description;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {      
        $data['user'] = $user;
        $data['skill'] = $user->profile->skills()->get();
        $data['work'] = $user->profile->works()->get();
        $data['workdesc'] = $user->profile->work_descriptions()->get();
        return view('profiles.index', ['data'=>$data])->with('i',0);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'objective' => 'required',
            'image' => '',
        ]);
        
        if(request('image')){
            $imagePath = request('image')->store('profile','public');
            $image = Image::make("images/{$imagePath}")->fit(1000,1000);
            $image->save();

            $imageArray = ['image'=> $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
