<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }//End Method

    public function UserProfile(){
        $id=Auth::user()->id;
        $profileData=User::find($id);
        return view('frontend.dashboard.edit_profile',compact('profileData'));
    }
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }//End Method`

    public function UserProfileStore(Request $request){
    $id=Auth::user()->id;
        $data=User::find($id);
        $data->name=$request->name;
        $data->username=$request->username;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;

        if($request->file('photo')){
            $file=$request->file('photo');
            @unlink(public_path('uploads/user_images/'.$data->photo));
            $fileName=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/user_images'),$fileName);
            $data->photo=$fileName;
        }

        $data->save();

        $successNotification=array(
            'message'=>'Profile updated successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($successNotification);
    }//End Method`

    public function UserChangePassword(){
        $id=Auth::user()->id;
        $profileData=User::find($id);
        return view('frontend.dashboard.user_change_password',compact('profileData'));
    }//End Method`
    
    public function UserUpdatePassword(Request $request){
        $request->validate(
            ['old_password'=>'required',
            'new_password'=>'required|confirmed']
        );
        if(!Hash::check($request->old_password,auth::user()->password)){
            $errorNotification=array(
                'message'=>'Old Password Does Not Match',
                'alert-type'=>'error',
            );
            return redirect()->back()->with($errorNotification);
        }

        User::whereId(auth::user()->id)->update([
            'password'=>Hash::make($request->new_password)
        ]);
        
        $successNotification=array(
            'message'=>'Password changed successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($successNotification);
        
    }//End Method`
    
}
