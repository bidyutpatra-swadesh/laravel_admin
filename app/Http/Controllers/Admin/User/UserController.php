<?php

namespace App\Http\Controllers\Admin\User;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','AdminMiddleWare']);
    }

    public function index()
    {
        $users=User::join('role_user','role_user.user_id','=','users.id')->join('roles','roles.id','=','role_user.role_id')->where('roles.name','Member User')->select('users.*')->get();
        return view('admin.user.index', compact('users'));
    }

    public function addUser(){
        $roles = Role::where('name','=','Member User')->get();
        return view('admin.user.add',compact('roles'));
    }
    public function saveUser(Request $request)
        {
            $msg = [
                'role_id.required' => 'Please Select Role',
                'name.required' => 'Enter Your Name',
                'email.required' => 'Enter Your email',
                'phone.required' => 'Enter Your Phone No',
                'member_id.required' => 'Enter Member Id',
            ];
            $this->validate($request, [
                'role_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'member_id' => 'required',
            ], $msg);
            $name = $request->get('name');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $member_id = $request->get('member_id');
            $role_id = $request->get('role_id');
            $User = new User();
            $User->name = $name;
            $User->email = $email;
            $User->phone = $phone;
            $User->password = bcrypt('123456');
            $User->user_password = base64_encode('123456');
            $User->member_id = $member_id;
            $User->status = 'Active';
            $User->save();
            $User->attachRole($role_id);
            return redirect()->back()->with('success','User Added Successfully !!!');
        }
        public function editUser($id){
            $userById = User::where('id', $id)->first();
            $roles = Role::where('name','=','Member User')->get();
            return view('admin.user.edit', compact('userById','roles'));
        }

    public function updateUser(Request $request)
    {
        $msg = [
            'role_id.required' => 'Please Select Role',
            'name.required' => 'Enter Your Name',
            'email.required' => 'Enter Your email',
            'phone.required' => 'Enter Your Phone No',
            'member_id.required' => 'Enter Member Id',
        ];
        $this->validate($request, [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'member_id' => 'required',
        ], $msg);

        $id = $request->get('id');
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $member_id = $request->get('member_id');
            User:: where('id',$id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'member_id' => $member_id,
            ]);

            return redirect()->back()->with('success', 'User Updated Successfully !!!');
    }

    public function active_inactive_user(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            User::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='<a href="javascript:void(0);" class="btn btn-xs btn btn-warning" onclick="active_inactive_user('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>&emsp;';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            User::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='<a href="javascript:void(0);" class="btn btn-xs btn btn-success" onclick="active_inactive_user('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>&emsp;';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }

    public function delUser($id)
    {
        $Remove = User::findOrFail($id);
        $Remove->detachRoles($Remove->roles);
        $Remove->delete();
        User:: where('id', $id)->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully !!!');
    }

    public function admin_index(){
        $users=User::join('role_user','role_user.user_id','=','users.id')->join('roles','roles.id','=','role_user.role_id')->where('roles.name','<>','User')->where('roles.name','<>','Member User')->select('users.*')->get();
        return view('admin.user.admin_index', compact('users'));
    }

    public function addAdminUser(){
        $roles = Role::where('roles.name','<>','User')->where('roles.name','<>','Member User')->get();
        return view('admin.user.add_admin',compact('roles'));
    }
    public function saveAdminUser(Request $request)
    {
        $msg = [
            'role_id.required' => 'Please Select Role',
            'name.required' => 'Enter Your Name',
            'email.required' => 'Enter Your email',
            'phone.required' => 'Enter Your Phone No',
        ];
        $this->validate($request, [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ], $msg);
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $role_id = $request->get('role_id');
        $User = new User();
        $User->name = $name;
        $User->email = $email;
        $User->phone = $phone;
        $User->password = bcrypt('123456');
        $User->user_password = base64_encode('123456');
        $User->status = 'Active';
        $User->save();
        $User->attachRole($role_id);
        return redirect()->back()->with('success','User Added Successfully !!!');
    }
    public function editAdminUser($id){
        $userById = User::where('id', $id)->first();
        $roles = Role::where('roles.name','<>','User')->where('roles.name','<>','Member User')->get();
        return view('admin.user.edit_admin', compact('userById','roles'));
    }
    public function updateAdminUser(Request $request)
    {
        $msg = [
            'role_id.required' => 'Please Select Role',
            'name.required' => 'Enter Your Name',
            'email.required' => 'Enter Your email',
            'phone.required' => 'Enter Your Phone No',
        ];
        $this->validate($request, [
            'role_id' => 'required',
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

        return redirect()->back()->with('success', 'User Updated Successfully !!!');
    }

    public function active_inactive_admin_user(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            User::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='<a href="javascript:void(0);" class="btn btn-xs btn btn-warning" onclick="active_inactive_admin_user('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>&emsp;';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            User::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='<a href="javascript:void(0);" class="btn btn-xs btn btn-success" onclick="active_inactive_admin_user('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>&emsp;';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }

    public function delAdminUser($id)
    {
        $Remove = User::findOrFail($id);
        $Remove->detachRoles($Remove->roles);
        $Remove->delete();
        User:: where('id', $id)->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully !!!');
    }


}
