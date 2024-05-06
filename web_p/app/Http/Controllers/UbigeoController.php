<?php

namespace App\Http\Controllers;

use App\Models\UbigeoModel;
use Exception;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function getProvincias($ubigeo){
        try {
            $provincias = UbigeoModel::where('nivel', 2)->where('ubigeo','like',$ubigeo.'%')->get();
            $distritos = UbigeoModel::where('nivel', 3)->where('ubigeo','like',$provincias[0]->ubigeo.'%')->get();
            return response(json_encode(array("error" => 0, "provincias" => $provincias, "distritos"=> $distritos)), 200);
        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }

    public function getDistritos($ubigeo){
        try {
            $distritos = UbigeoModel::where('nivel', 3)->where('ubigeo','like',$ubigeo.'%')->get();
            return response(json_encode(array("error" => 0, "distritos" => $distritos)), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1)), 200);
        }
    }
}
