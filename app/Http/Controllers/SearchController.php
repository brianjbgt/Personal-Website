<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequests;
use App\User;

class SearchController extends Controller {
    public function search(){
        $search=request('search');
        $users = User::query()
                    ->where('username', 'LIKE', "%{$search}%") 
                    ->orWhere('email', 'LIKE', "%{$search}%") 
                    ->paginate(10);
        return view('search.index',compact('users'));
    }
}


  