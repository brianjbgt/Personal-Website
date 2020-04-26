<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    public $timestamps = false;

    protected $guarded = [];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
