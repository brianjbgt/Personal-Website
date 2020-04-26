<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'work';
    public $timestamps = false;

    protected $fillable = ['prof_id','title','period','company','address','count','description'];

    public function profile(){
        return $this->belongsTo(Profile::class, 'prof_id');
    }

    public function work_descriptions(){
        return $this->hasMany(Work_description::class,'work_id');
    }
}
