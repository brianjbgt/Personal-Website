<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'username', 'email', 'password', 'acct_type', 'adpassword'
    ];

    public $timestamps = false;

    public function profile(){
        return $this->belongsto(Profile::class,'prof_id');
    }
}
