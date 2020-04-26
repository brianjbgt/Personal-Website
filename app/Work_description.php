<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_description extends Model
{
    protected $table = 'work_description';
    public $timestamps = false;

    protected $fillable = ['work_id','description','count','title'];

    public function work(){
        return $this->belongsTo(Work::class,'work_id');
    }
}
