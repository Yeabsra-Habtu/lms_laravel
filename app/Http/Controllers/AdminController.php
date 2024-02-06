<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }//End Method

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//End Method`

    public function AdminLogin(){
        return view('admin.admin_login');
    }//End Method

    public function AdminProfile(){
        $id=Auth::user()->id;
        $profileData=User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }//End Method

    public function AdminProfileStore(Request $request){
        $id=Auth::user()->id;
        $data=User::find($id);
        $data->name=$request->name;
        $data->username=$request->username;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;

        if($request->file('photo')){
            $file=$request->file('photo');
            @unlink(public_path('uploads/admin_images/'.$data->photo));
            $fileName=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$fileName);
            $data->photo=$fileName;
        }

        $data->save();

        $successNotification=array(
            'message'=>'Profile updated successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($successNotification);


    }//End Method

    
    public function AdminChangePassword(){
        $id=Auth::user()->id;
        $profileData=User::find($id);
        return view('admin.admin_change_password',compact('profileData'));
    }//End Method

    public function AdminPasswordUpdate(Request $request){
        
        //Validation
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
