<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserController extends Controller
{
    const TRUE = "true";
    const FALSE= "false";
public function register(Request $request)
        {

            $validator =  Validator::make($request->all(), [
                'email' => 'required|unique:users',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    "flag" => Self::FALSE,
                    "message" => $validator->errors()->first(),
                    "error" => 'validation_error',
                ], 422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' =>$request->email,
                'password' => Hash::make($request->password),
                'type'=>$request->type,
            ]);
            $images = $request->file('image');
            if ($images) {
                $filename = rand() . '.' . $images->getClientOriginalExtension();
                $images->move(storage_path('app/public/profile'), $filename);
                $user->profile = $filename;
                $user->save();
            }

            $token = $user->createToken('Token')->accessToken;

            return response([ 'token' => $token,'user' => $user,],200);
        }
public function login(Request $request)
{
    if ($request->input('type') == "user") {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            'type' => 'required',
        ]);

    if(auth()->attempt($loginData)){
        $token= auth()->user()->createToken('Token')->accessToken;
        return response([ 'token' => $token,'data' => $loginData, ]);
    }
    else{

        return  Helper::setresponse(Self::FALSE, "", "No record found.",404);
    }
    }
else{
    $loginData = $request->validate([
        'email' => 'email|required',
        'password' => 'required'
    ]);

if(auth()->attempt($loginData)){
    $token= auth()->user()->createToken('Token')->accessToken;
    return response([ 'token' => $token,'data' => $loginData, ]);
    }
    else{

        return  Helper::setresponse(Self::FALSE, "", "No record found.",404);
    }
}
}
public function profile(Request $request,$id)
{
    $user= User::find($id);
    $images = $request->file('image');
        if ($images) {
            $filename = rand() . '.' . $images->getClientOriginalExtension();
            $images->move(storage_path('app/public/profile'), $filename);
            $user->image = $filename;
            $user->update();
        }
        if ($user) {
            return  Helper::setresponse(Self::TRUE, $user, "false",200);
        } else {
            return Helper::setresponse(Self::FALSE, "", "no data found ",404);
        }

}
public function changepassword(Request $request)
{

    $validator =  Validator::make($request->all(), [
        'old_password' => 'required',
        'password'=>'required|min:6|max:100',
        'confirm_password'=>'required|same:password',

    ]);
    if ($validator->fails()) {
        return response()->json([
            "flag" => Self::FALSE,
            "message" => $validator->errors()->first(),
            "error" => 'validation_error',
        ], 422);
    }
    $user=$request->user();
    if(Hash::check($request->old_password,$user->password)){
    $user->update([
    'password'=>Hash::make($request->password)
]);
return response()->json([
    "flag" => Self::FALSE,
    "message" => 'paassword updated successfully.',
], 200);
    }else{
        return response()->json([
            "flag" => Self::FALSE,
            "message" => 'old password does not matched',
        ], 400);
    }
}
  public function forgetPassword(Request $request)
{
    $user =User::where('email',$request->email)->get();
    if(count($user)>0){

        $token =Str::random(40);
    
    }
    else{
return response()->json(['success'=>false,'msg'=>'user not found']);
    }
}
}




