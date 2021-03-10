<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{   
    public function __construct() {
        $this->middleware('auth:api',['except' => ['index','show']]);
    }

    public function index()
    {   
        $notification = DB::table('posts')
                ->where('is_public',1);
        return DB::table('notifications')
                ->select('id',
                         'title',
                         'content',
                         'file_path',
                         'user_id',
                         DB::raw('false AS is_public'),
                         'created_at',
                         'updated_at'
                        )
                ->union($notification)
                ->orderBy('updated_at','DESC')
                ->get();
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|max:255',
            'content' => 'required',
            'file_path' => 'max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        return Notification::create(array_merge(
            $validator->validated(),
            ['user_id' => (int)Auth::id()]
        ));
    }

    public function show($id)
    {
        return Notification::find($id);
    }

    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'title' => 'max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $notification=Notification::find($id);
        $notification->update($request->all());
        return $notification;
    }

    public function destroy($id)
    {
        return Notification::destroy($id);
    }
}
