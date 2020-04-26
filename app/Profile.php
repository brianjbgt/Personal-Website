<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user(){
        return $this->belongsto(User::class);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }

    public function educations(){
        return $this->hasMany(Education::class, 'prof_id');
    }

    public function works(){
        return $this->hasMany(Work::class, 'prof_id');
    }

    public function work_descriptions(){
        return $this->hasManyThrough(Work_description::class, Work::class, 'prof_id','work_id','id','id');
    }

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : '/images/profile/saitama.jpg';
        return '/images/' . $imagePath;
    }
}
