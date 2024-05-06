<?php

namespace App\Http\Controllers\api;

use App\Models\api\Sections;
use Illuminate\Support\Str;
use App\Models\AppUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends ApiController
{

    public function login(Request $request){
        try{
            $msg = "Usuario o contraseña errónea";
            $appUser = AppUserModel::where('email', $request->input('email'))->first();
            if($appUser){
                if(Hash::check($request->input('password'), $appUser->password)){
                    $token = (string)Str::uuid();
                    $hashed = hash('sha256', $token);
                    $appUser->api_token = $hashed;
                    $appUser->save();
                    $user = [
                        'name' => $appUser->name,
                        'token' => $hashed
                    ];
                    return json_encode(['error' => 0, 'data' => json_encode($user)]);
                }
                return json_encode(['error' => 0, 'data' => null, 'message' => $msg]);
            }
            return json_encode(['error' => 0, 'data' => null, 'message' => $msg]);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }

    public function createUser(Request $request){
        try{
            $appUser = new AppUserModel();
            $appUser->name = $request->input('name');
            $appUser->last_name = $request->input('last_name');
            $appUser->email = $request->input('email');
            $appUser->address = $request->input('address');
            $appUser->ubigeo = $request->input('ubigeo');
            $appUser->interior = $request->input('interior');
            $appUser->password = Hash::make($request->input('password'));
            $appUser->save();
            return json_encode(['error' => 0, 'data' => '']);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }

    public function updateUser($id, Request $request){
        try{
            $appUser = AppUserModel::where('id',$id)->first();
            $appUser->name = $request->input('name');
            $appUser->last_name = $request->input('last_name');
            $appUser->email = $request->input('email');
            $appUser->address = $request->input('address');
            $appUser->ubigeo = $request->input('ubigeo');
            $appUser->interior = $request->input('interior');
            $appUser->password = Hash::make($request->input('password'));
            $appUser->save();
            return json_encode(['error' => 0, 'data' => '']);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }

    public function getUser($id){
        try{
            $appUser = AppUserModel::where('id',$id)->first();
            return json_encode(['error' => 0, 'data' => json_decode($appUser)]);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }
}
