<?php

namespace App\Http\Controllers;

use App\Mail\AccessEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'password' => 'bail|required|regex:/^.*(?=.{8,30})(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!$#%.,^&]).*$/',
            'department_id' => 'bail|required|min:1|exists:departments,id',
            'access' => 'boolean'
        ]);
        $user=User::find($id);
        $user->update($validator->validated());
        return $user;
    }

    public function changeAccess($id)
    {   $user=User::find($id);
        $data=[
            'adminEmail'=>User::find(Auth::id())->email,
            'name'=>$user->fname.' '.$user->lname
        ];
        Mail::to($user->email)->send(new AccessEmail($data)); 
        if($user->access){
            return $user->update(['access'=>0]);
        }
        return $user->update(['access'=>1]);
    }

    public function changeAllNewStudentAccess()
    {   
        return User::where('user_type_id', 4)
                    ->where('access', 0)
                    ->update(['access'=>1]);
    }

    public function getUsersWithoutAccess()
    {   
        return User::where('access', 0)
                ->orderBy('created_at','DESC')
                ->get();
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
