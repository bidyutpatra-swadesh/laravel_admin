<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function Check_login(Request $request)
    {
        //dd($request->all());

        $msg = [
            'email.required' => 'Enter Your Email',
            'password.required' => 'Enter Your Password',
        ];
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|alphaNum|min:3'

        ], $msg);

        $email = $request->get('email');
        $pass = $request->get('password');
        $uid = User::where('email', $email)->orWhere('phone', $email)->value('id');
        $role_id = RoleUser::where('user_id', $uid)->value('role_id');
        $role = Role::where('id', $role_id)->value('name');
        if ($role == 'admin') {
            if (Auth::attempt(array('email' => $email, 'password' => $pass,'status'=>'Active'), true)) {
                $check_email = Auth::user()->email;
                $request->session()->put('email', $check_email);
                $user_type = Auth::user()->user_type;
                $request->session()->put('user_type', $user_type);
                    return redirect(route('admin::dashboard'));
            } else {
                return redirect()->back()->with('error', 'Login Failed !!! Please check Your Email and Password.');
            }
        }
        else if($role == 'sub admin'){
            if (Auth::attempt(array('email' => $email, 'password' => $pass,'status'=>'Active'), true)) {
                $check_email = Auth::user()->email;
                $request->session()->put('email', $check_email);
                $user_type = Auth::user()->user_type;
                $request->session()->put('user_type', $user_type);
                return redirect(route('admin::dashboard'));
            } else {
                return redirect()->back()->with('error', 'Login Failed !!! Please check Your Email and Password.');
            }
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect('/admin')->with('logout','Logout Successfully !!!');
    }

    public function changePassForm()
    {
        return view('admin.password.changePassword');
    }

    public function ChangePass(Request $request)
    {
        $msg = [
            'old_pass.required' => 'Enter Your Old Password',
            'new_pass.required' => 'Enter Your New Password',
            'confirm_pass.required' => 'Enter Your Confirm Pasword',
        ];
        $this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required',
        ], $msg);
        $old_pass=$request->old_pass;
        $new_pass=$request->new_pass;
        $confirm_pass=$request->confirm_pass;
        $id=Auth::user()->id;
        $pass=User::where('id',$id)->value('password');
        if(Hash::check($old_pass,$pass)){
            if($new_pass==$confirm_pass){
                $password=Hash::make($new_pass);
                $changePass=User::where('id',$id)->update([
                    'password' => $password,
                ]);
                if($changePass==true){
                    return redirect()->back()->with('success',"Password Updated Sucessfully !!!" );
                }
            }
            else{
                return redirect()->back()->with('error',"New Password and Confirm Password are Not Matched !!!" );
            }
        }
        else{
            return redirect()->back()->with('error',"Old Password Not Matched !!!" );
        }

    }

    public function profile($id){
        $userById=User::where('id',$id)->first();

        return view('admin.profile.index',compact('userById'));
    }

    public function updateProfile(Request $request){
        $msg = [
            'name.required' => 'Enter Your Name',
            'email.required' => 'Enter Your Email',
            'phone.required' => 'Enter Your Phone No',
        ];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ], $msg);

        $id = $request->get('id');
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        User:: where('id',$id)->update([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully !!!');
    }
}
