<?php

namespace App\Http\Controllers;
Use App\Profile;
Use App\Work;
Use App\Work_description;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Profile $profile){
        $data['work'] = Profile::find($profile->id)->works()->get();
        $data['workdesc'] = Profile::find($profile->id)->work_descriptions()->get();
        
        return view('work.index', ['data'=>$data])->with('i',0);
    }

    public function create()
    {
        return view('work.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'period' => 'required',
            'company' => 'required',
            'address' => 'required',
        ]);

        $ctr = 0;
        $work = auth()->user()->profile->works()->create($data);
        $workid = $work->id;
        $all = request()->all();

        foreach($all as $key=>$value){
            if ($ctr > 4){
                auth()->user()->profile->work_descriptions()->create([
                    'work_id'=>$workid,
                    'description'=>$value
                ]);
            }
            $ctr++;
        }
        return redirect('/work/' . auth()->user()->profile->id);
    }

    public function edit(Work $work)
    {
        $this->authorize('update', auth()->user()->profile);

        $data['work'] =  Work::where('id',$work->id)->first();
        $data['workdesc'] = Work::find($work->id)->work_descriptions()->get();

        return view('work.edit', ['data'=>$data])->with('i',0);
    }

    public function update(Work $work)
    {
        $this->authorize('update', auth()->user()->profile);
        
        $data['workdesc'] = Work::find($work->id)->work_descriptions()->get();
        $data['descId'] = Work::find($work->id)->work_descriptions()->pluck('id')->toArray();
        $count = count($data['workdesc']);

        $ctr = 0;
        $ctrd = 0;
        $bound = 6+$count;
        $workid = $work->id;
        $all = request()->all();
        $text = " ";
        foreach($all as $key=>$value){ 
            if ($ctr > 5 AND $ctr < $bound AND isset($value)){
                $curDesc = $data['descId'][$ctrd];
                $workdesc = Work_description::find($curDesc);
                $workdesc->description = $value;
                $workdesc->save();
                $ctrd++;
            }elseif ($ctr >= $bound AND isset($value)) {
                auth()->user()->profile->work_descriptions()->create([
                    'work_id'=>$workid,
                    'description'=>$value
                ]);
            }
            $ctr++;
        }

        $data = request()->validate([
            'title' => 'required',
            'period' => 'required',
            'company' => 'required',
            'address' => 'required',
        ]);
        $work->update($data);
        return redirect('/work/' . auth()->user()->profile->id);
    }

    public function show(Work $work){
        return view('work.show', compact('work'));
    }

    public function delete(Work $work)
    {
        $id = $work->id;
        $workDesc = Work_description::where('work_id',$id);
        $workDesc->delete();
        $work->delete();
        
        return redirect("/work/" . auth()->user()->profile->id);
    }   
    
    public function delDesc($id)
    {
        $workDesc = Work_description::find($id);
        $work_id = Work_description::where('id',$id)->pluck('work_id')->first();
        $workDesc->delete();

        return redirect("/work/". $work_id . "/edit");
    }
}
