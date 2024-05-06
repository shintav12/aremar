<?php

namespace App\Http\Controllers;

use App\Models\AppUserModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\SectionModel;
use App\Models\UbigeoModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        $user = session('user');
        if($user){
            return redirect()->route('home');
        }
        return view('pages.auth.login');
    }

    public function register(){
        $user = session('user');
        if($user){
            return redirect()->route('home');
        }
        return view('pages.auth.register');
    }

    public function profile(){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $user = session('user');
        $user->distrito = UbigeoModel::where('ubigeo', $user->ubigeo)->first();
        $user->provincia = UbigeoModel::where('ubigeo', substr($user->ubigeo,0,4))->first();
        $user->departamento = UbigeoModel::where('ubigeo', substr($user->ubigeo,0,2))->first();
        $orders = OrderModel::where('user_id',$user->id)->get();
        foreach ($orders as $key => $value) {
            $value->detail = OrderDetailModel::where('order_id', $value->id)
            ->join('products','order_detail.product_id','=','products.id')
            ->join('metals','order_detail.metal_id','=','metals.id')
            ->select('products.name',DB::raw('metals.name as metal_name'), 'order_detail.price')
            ->get();
            $value->distrito = UbigeoModel::where('ubigeo', $value->ubigeo)->first();
            $value->provincia = UbigeoModel::where('ubigeo', substr($value->ubigeo,0,4))->first();
            $value->departamento = UbigeoModel::where('ubigeo', substr($value->ubigeo,0,2))->first();
        }
        $template = [
            'user' => $user,
            'orders' => $orders,
            'sections' => $sections
        ];
        return view('pages.profile.profile', $template);
    }

    public function signup(Request $request){
        try {
            $name = $request->input('name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $password = $request->input('password');
            $user = AppUserModel::where('email',$email)->get();
            if(count($user) > 0){
                return response(json_encode(array("error" => 1, "message" => "Correo no disponible")), 200);
            }
            $user = new AppUserModel();
            $user->last_name = $last_name;
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();
            session()->put('user', $user);
            return response(json_encode(array("error" => 0, "id" => $user->id)), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }

    public function signin(Request $request){
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $user = AppUserModel::where('email',$email)->first();

            if(!$user){
                return response(json_encode(array("error" => 1, "message" => "Email y/o Clave incorrectos")), 200);
            }
            if(!Hash::check($password, $user->password)){

                return response(json_encode(array("error" => 1, "message" => "Email y/o Clave incorrectos")), 200);
            }
            session()->put('user', $user);
            return response(json_encode(array("error" => 0)), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('home');
    }

    public function forgotPassword(){
        $template = [
        ];
        return view('pages.auth.forgot-password', $template);
    }

    public function sendEmailRecoveryPassword(Request $request){
        try {
            $email = $request->input('email');
            $newPassword = $request->input('newpassword');
            $repeatpassword = $request->input('repeatpassword');
            $user = AppUserModel::where('email',$email)->first();
            if($user){
                if(strcmp($newPassword,$repeatpassword) == 0){
                    $user->password = Hash::make($newPassword);
                    $user->save();
                }else{
                    return response(json_encode(array("error" => 0, "message" => "Las contraseñas no coinciden")), 200);
                }
            }
            return response(json_encode(array("error" => 0, "message" => "Si existe un usuario registrado con el correo ingresado, la contraseña sera reiniciada")), 200);
        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }

    public function changePasswordForm(Request $request){
        try {
            $user = session('user');
            $user = AppUserModel::where('email', $user->email)->first();
            $newPassword = $request->input('newpassword');
            $repeatpassword = $request->input('repeatpassword');
            if(strcmp($newPassword,$repeatpassword) == 0){
                $user->password = Hash::make($newPassword);
                $user->save();
                session()->put('user',$user);
            }else{
                return response(json_encode(array("error" => 0, "message" => "Las contraseñas no coinciden")), 200);
            }
            return response(json_encode(array("error" => 0, "message" => "La clave se ha cambiado")), 200);
        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }

    public function changePassword(){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $template = [
            'user' => session('user'),
            'sections' => $sections,
        ];
        return view('pages.profile.change-password', $template);
    }

    public function changeAddress(){
        $user = session('user');
        $ubigeo = $user->ubigeo;
        $departamentos = UbigeoModel::where('nivel',1)->get();
        if($ubigeo){
            $dep = substr($ubigeo,0,2);
            $prov = substr($ubigeo,0,4);
            $provincias = UbigeoModel::where('nivel', 2)->where('ubigeo','like',$dep.'%')->get();
            $distritos = UbigeoModel::where('nivel', 3)->where('ubigeo','like',$prov.'%')->get();
        }else{
            $dep = '';
            $prov = '';
            $provincias = UbigeoModel::where('nivel', 2)->where('ubigeo','like',$departamentos[0]->ubigeo.'%')->get();
            $distritos = UbigeoModel::where('nivel', 3)->where('ubigeo','like',$provincias[0]->ubigeo.'%')->get();
        }

        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $template = [
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
            'ubigeo' => $ubigeo,
            'user' => $user,
            'dep'=> $dep,
            'prov' => $prov,
            'sections' => $sections,
        ];
        return view('pages.profile.change-address', $template);
    }

    public function changeAddressForm(Request $request){
        try {
            $user = session('user');
            $user = AppUserModel::where('email', $user->email)->first();
            $ubigeo = $request->input('ubigeo');
            $postal = $request->input('postal');
            $address = $request->input('address');
            $interior = $request->input('interior');
            $user->ubigeo = $ubigeo;
            $user->address = $address;
            $user->interior = $interior;
            $user->postal_code = $postal;
            session()->put('user',$user);
            $user->save();
            return response(json_encode(array("error" => 0, "message" => "La información ha sido actualizada")), 200);
        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }
}
