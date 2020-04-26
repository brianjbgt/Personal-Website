<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Profile;


class UsersController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('user.index');
    }

    public function getAll(){
        return User::all()->toJson();
    }

    public function get(User $user){
        return $user->toJson();
    }

    public function store(UserRequest $request){
        $UserObj = new User;
        $UserObj->username = $request->input('username');
        $UserObj->email = $request->input('email');
        $UserObj->password =  $request->input('password');
        $UserObj->acct_type = $request->input('acctType');
        $UserObj->save();

        return response()->json(['message'=>'success']);
    }

    public function update(UserRequest $request, User $user){
        // $education->title = $request->input('title');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password =  $request->input('password');
        $user->acct_type = $request->input('acct_type');
        $user->save();

        return response()->json(['message'=>'success']);
    }


    public function delete(User $user){
        if(!is_null($user->profile)){
            $user->profile->works()->delete();
            $user->profile->delete();
        }

        $user->delete();

        return response()->json(['message' => 'Successfully Deleted Entry: '.$user->username]);
    }

}