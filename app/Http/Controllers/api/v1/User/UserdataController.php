<?php

namespace App\Http\Controllers\api\v1\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserdataController extends Controller
{

    public function get_user_data(){
            $user = User::where('id', 1)->get();
            return $user;
    }
}
