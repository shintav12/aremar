<?php

namespace App\Http\Controllers;

use App\Models\OfferModel;
use App\Models\ProductModel;
use App\Models\SectionModel;
use App\Models\UserNewsLetterModel;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function view(){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $vitrina = SectionModel::where('id', 1)->first();
        $ofertas_header = OfferModel::where('status',1)->orderBy('id', 'desc')->limit(3)->get();
        foreach($ofertas_header as $offer){
            $offer->producto = ProductModel::where('id', $offer->product_id)->first();
        }
        $ofertas = OfferModel::where('status',1)->orderBy('id','desc')->offset(3)->limit(4)->get();
        $productos = ProductModel::where('status',1)->orderBy('id', 'desc')->offset(3)->limit(4)->get();
        foreach($ofertas as $offer){
            $offer->producto = ProductModel::where('id', $offer->product_id)->first();
        }

        $template = [
            'user' => session('user'),
            'sections' => $sections,
            'vitrina' => $vitrina,
            'ofertas_header' => $ofertas_header,
            'ofertas' => $ofertas,
            'productos' => $productos
        ];
        return view('pages.home', $template);
    }

    public function registerToNewsLetter(Request $request){
        try {
            $name = $request->input('email');

            $user = new UserNewsLetterModel();
            $user->email = $name;
            $user->save();
            return response(json_encode(array("error" => 0, "id" => $user->id)), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1, "message" => "Hubo un problema con el registro")), 200);
        }
    }
}
