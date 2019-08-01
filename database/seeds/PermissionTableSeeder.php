<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Basic Roll

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Project Admin';
        $admin->description  = 'User is the admin of the project';
        $admin->save();

        //Add User With Role


        $Admin = New App\User();
        $Admin->name = "Admin";
        $Admin->phone = "8371894035";
        $Admin->password = bcrypt("123456");
        $Admin->user_password = base64_encode('123456');
        $Admin->status = 'Active';
        $Admin->save();
        $Admin->attachRole($admin);

        $permissions = [
            [
                'group_name'=>'Role',
                'name'=>'view-role',
                'display_name'=>'View Role',
                'description'=>'Users who has this permission can view roles'
            ],
            [
                'group_name'=>'Role',
                'name'=>'add-role',
                'display_name'=>'Add Role',
                'description'=>'Users who has this permission can add roles'
            ],
            [
                'group_name'=>'Role',
                'name'=>'update-role',
                'display_name'=>'Update Role',
                'description'=>'Users who has this permission can update roles'
            ],
            [
                'group_name'=>'Role',
                'name'=>'delete-role',
                'display_name'=>'Delete Role',
                'description'=>'Users who has this permission can delete roles'
            ],
            //Permission
            [
                'group_name'=>'Permission',
                'name'=>'view-permission',
                'display_name'=>'View Permission',
                'description'=>'Users who has this permission can view permission'
            ],
            [
                'group_name'=>'Permission',
                'name'=>'add-permission',
                'display_name'=>'Add Permission',
                'description'=>'Users who has this permission can add permission'
            ],
            [
                'group_name'=>'Permission',
                'name'=>'update-permission',
                'display_name'=>'Update Permission',
                'description'=>'Users who has this permission can update permission'
            ],
            [
                'group_name'=>'Permission',
                'name'=>'delete-permission',
                'display_name'=>'Delete Permission',
                'description'=>'Users who has this permission can delete permission'
            ],
            //Users
            [
                'group_name'=>'Users',
                'name'=>'view-user',
                'display_name'=>'View Users',
                'description'=>'Users who has this permission can view user lists'
            ],
            [
                'group_name'=>'Users',
                'name'=>'add-user',
                'display_name'=>'Add User',
                'description'=>'Users who has this permission can add new user'
            ],
            [
                'group_name'=>'Users',
                'name'=>'update-user',
                'display_name'=>'Update User',
                'description'=>'Users who has this permission can update user details'
            ],
            [
                'group_name'=>'Users',
                'name'=>'delete-user',
                'display_name'=>'Delete User',
                'description'=>'Users who has this permission can delete user'
            ],
        ];


        foreach($permissions as $permission){
            $permissionID = Permission::create($permission);
            $admin->attachPermission($permissionID);
        }
    }
}
