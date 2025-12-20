<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserServices $userServices;

    public function __construct(UserServices $userServices){
        $this->userServices = $userServices;
    }
    public function login(){
        return response()->view('user.login',[
            'title' => 'Login Management'
        ]);
    }
    public function doLogin(Request $request): Response | RedirectResponse{
        $user = $request->input('user');
        $password = $request->input('password');
        
        if(empty($user) || empty($password)){
            return response()->view('user.login',[
                'title' => 'Login Management',
                'error' => 'User or Password is empty'
            ]);
        }

        if($this->userServices->login($user, $password)){
            $request->session()->put('user', $user);
            return redirect('/');
        }
        return response()->view('user.login',[
            'title' => 'Login Management',
            'error' => 'User or Password is incorrect'
        ]);
    }
    public function doLogout(Request $request): Response | RedirectResponse{
        $request->session()->forget('user');
        return redirect('/');
    }
}
