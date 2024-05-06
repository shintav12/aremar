<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\AuthUser;
use App\Repository\AuthUserRepository;
use Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    protected $modelClass =AuthUser::class;
    protected $repositoryClass = AuthUserRepository::class;
    protected $title = "Usuarios";

    public function index(){
        if(Session::has('user')){
            $user = Session::get('user');
            foreach($user->permissions as $i => $j){
                if($j['location'] != ''){
                    return redirect($j['location']);
                    break;
                }
            }
        }
        return view('templates.auth.login');
    }

    public function login(LoginRequest $request){

        if(Session::has('user')){
            $user = Session::get('user');
            foreach($user->permissions as $i => $j){
                if($j['location'] != ''){
                    return redirect($j['location']);
                    break;
                }
            }
        }

        $validated = $request->validated();
        $result = $this->repository->verify($validated['username'],$validated['password'],$user);
        if($result){
            //Session::put("user",$user);
            $this->repository->permissions($user);
            Session::put("user",$user);
            if(count($user->permissions)>0){
                foreach ($user->permissions as $k => $v) {
                    if ($v['location'] != '') {
                        return Redirect::route($v['location']);
                        break;
                    }
                }
            }else{
                $message = Lang::get('auth.permissions');
                return Redirect::route("index")->withInput(Request::all())->withErrors([
                    'validation' => [$message]
                ]);
            }
        }else{
            $message = Lang::get('auth.failed');
            return Redirect::route("index")->withInput(Request::all())->withErrors([
                'validation' => [$message]
            ]);
        }
    }

    public function logout(Request $request) {
        session()->forget('user');
        return redirect()->route('index');
    }

}
