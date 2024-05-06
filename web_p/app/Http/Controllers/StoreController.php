<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CollectionsModel;
use App\Models\MetalsModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SectionModel;
use App\Models\UbigeoModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function category($slug){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $vitrina = SectionModel::where('slug', $slug)->first();
        $products = ProductModel::where('sections','like',"% ".$vitrina->id." %")->where('status',1)->get();
        $metals = MetalsModel::where('status',1)->get();
        $collections = CollectionsModel::where('status',1)->get();
        $categories = CategoryModel::where('status',1)->get();
        $user = session('user');
        $cart = [];
        if(session('cart')){
            $cart = session('cart');
        }
        $template = [
            'sections' => $sections,
            'vitrina' => $vitrina,
            'products' => $products,
            'metals' => $metals,
            'collections' => $collections,
            'categories' => $categories,
            'slug' => $slug,
            'cart' => $cart,
            'user' => $user
        ];
        return view('pages.store',$template);
    }

    public function filters(Request $request){
        try {

            $section = $request->input('section_slug');
            $order = $request->input('order_id');
            $category = intval($request->input('category'));
            $metals = $request->input('metals');
            $collection = intval($request->input('collection'));
            $vitrina = SectionModel::where('slug', $section)->first();
            $sql =  "SELECT * FROM products p where p.status = 1 AND p.sections like  '% $vitrina->id %' ";
            if($category !== 0){
                $sql = $sql." AND p.category_id  = $category ";
            }
            if($metals !== "0"){
                $sql = $sql." AND p.metals like '% $metals %' ";
            }
            if($collection !== 0){
                $sql = $sql." AND p.collection_id = $collection ";
            }

            if($order == 1){
                $sql = $sql. " ORDER BY p.name";
            }else if ($order == 2){
                $sql = $sql. " ORDER BY p.price DESC";
            }else{
                $sql = $sql. " ORDER BY p.price";
            }

            $products = DB::select(DB::raw($sql));

            return response(json_encode(array("error" => 0, "products" => $products)), 200);
        }catch(Exception $e){
            return response(json_encode(array("error" => 1, "products" => [])), 200);
        }
    }

    public function detail($category,$slug){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $metals = MetalsModel::where('status',1)->get();
        $collections = CollectionsModel::where('status',1)->get();
        $categories = CategoryModel::where('status',1)->get();
        $product = ProductModel::where('slug', $slug)->first();
        $user = session('user');
        $cart = [];
        if(session('cart')){
            $cart = session('cart');
        }
        $related = DB::select(DB::raw("SELECT *
        FROM products p
        WHERE p.id != $product->id
        AND p.category_id = $product->category_id
        ORDER BY RAND()
        LIMIT 4
        "));
        $images = ProductImageModel::where('product_id', $product->id)->get();
        $template = [
            'sections' => $sections,
            'metals' => $metals,
            'collections' => $collections,
            'categories' => $categories,
            'product' => $product,
            'images' => $images,
            'related' => $related,
            'user' => $user,
            "slug" => $slug,
            'cart' => $cart
        ];
        return view('pages.product_detail',$template);
    }

    public function addCart(Request $request){

        try {
            $id = $request->input('id');
            $metal = $request->input('metal');
            $cart = session('cart');
            if(!$cart){
                $cart = [];
            }
            $product = ProductModel::where('id', $id)->first();
            $metals = MetalsModel::where('id',$metal)->first();
            $uuid = uniqid();
            $product->metal_id = $metal;
            $product->metal_name = $metals->name;
            $product->uuid = $uuid;
            $cart[$uuid] = $product;
            session()->put('cart', $cart);
            return response(json_encode(array("error" => 0, "cart" => $cart)), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1, "message" => "Hubo un problema con el registro")), 200);
        }
    }

    public function removeCart($uuid){
        try {
            $cart = session('cart');
            if(!$cart){
                $cart = [];
            }
            unset($cart[$uuid]);
            session()->put('cart', $cart);
            return response(json_encode(array("error" => 0, "cart" => $cart)), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1, "message" => "Hubo un problema con el registro")), 200);
        }
    }

    public function checkout(Request $request){
        $products = session('cart');
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
        if(!$products) $products = [];
        $template = [
            'products' => $products,
            'sections' => $sections,
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
            'dep'=> $dep,
            'ubigeo' => $ubigeo,
            'prov' => $prov,
            'user' => $user
        ];
        return view('pages.checkout',$template);
    }

    public function checkoutAction(Request $request){

        try {

            \MercadoPago\SDK::setAccessToken(config('app.mercado_pago_secret_token'));

            $amount = 0;
            $description = [];
            $user = session('user');
            $products = session('cart');
            foreach ($products as $value) {
                $amount = $amount + $value->price;
                $description[] = $value->name;
            }


            $payment = new \MercadoPago\Payment();
            $payment->transaction_amount = $amount;
            $payment->token = $request->input('token');
            $payment->payment_method_id = $request->input('paymentMethodId');
            $payment->issuer_id  = $request->input('issuer');
            $payment->description = "Joyas Aremar, ". implode(', ', $description);
            $payment->installments = 1;

            $payer = new \MercadoPago\Payer();
            $payer->email = $request->input('email');
            $payer->identification = array(
                "type" => $request->input('docType'),
                "number" => $request->input('docNumber')
            );

            $payment->payer = $payer;

            $payment->save();
            $response = array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id
            );

            if(!$payment->status){
                return response(json_encode(array("error" => 1, "message" => "Hubo un problema en el proceso")), 200);
            }

            if($payment->status === "rejected"){
                if($payment->status_detail === "cc_rejected_bad_filled_card_number")
                    return response(json_encode(array("error" => 1, "message" => "Revisa el número de tu tarjeta")), 200);
                else if($payment->status_detail === "cc_rejected_bad_filled_date")
                    return response(json_encode(array("error" => 1, "message" => "Revisa la fecha de expiración de tu tarjeta")), 200);
                else if($payment->status_detail === "cc_rejected_bad_filled_other")
                    return response(json_encode(array("error" => 1, "message" => "Revisa la información de pago ingresada")), 200);
                else if($payment->status_detail === "cc_rejected_bad_filled_security_code")
                    return response(json_encode(array("error" => 1, "message" => "Revisa el código de seguridad ingresado")), 200);
                else if($payment->status_detail === "cc_rejected_other_reason")
                    return response(json_encode(array("error" => 1, "message" => "Tu pago no puede ser procesado, consulta con tu entidad bancaria")), 200);
                else if($payment->status_detail === "cc_rejected_insufficient_amount")
                    return response(json_encode(array("error" => 1, "message" => "Fondos insuficientes")), 200);
                else
                    return response(json_encode(array("error" => 1, "message" => "Tu pago no puede ser procesado")), 200);
            }


            $order = new OrderModel();
            $order->user_id = ($user) ? $user->id : 0;
            $order->description = implode(',', $description);
            $order->email = $request->input('email');
            $order->ubigeo = $request->input('ubigeo');
            $order->name = $request->input('shipment_name');
            $order->last_name = $request->input('shipment_last_name');
            $order->address = $request->input('shipment_address');
            $order->interior = $request->input('shipment_interior');
            $order->postal_code = $request->input('shipment_postal_code');
            $order->document_type = $request->input('docType');
            $order->document_number = $request->input('docNumber');
            $order->monto_total =  $amount;
            $order->payment_response =  json_encode($response);
            $order->save();

            foreach ($products as $value) {
                $detail = new OrderDetailModel();
                $detail->product_id = $value->id;
                $detail->order_id = $order->id;
                $detail->metal_id = $value->metal_id;
                $detail->price = $value->price;
                $detail->save();
            }
            if($payment->status === "approved"){
                session()->put('cart', []);
                return response(json_encode(array("error" => 0, "message" => "Hemos procesado tu pago exitosamente")), 200);
            } else{
                session()->put('cart', []);
                return response(json_encode(array("error" => 0, "message" => "No te preocupes, estamos procesando tu pago, serás notificado via email si es que necesitamos más información para procesar tu pago")), 200);
            }
            return response(json_encode(array("error" => 1, "message" => "Hubo un problema con el registro")), 200);
        } catch (Exception $e) {
            return response(json_encode(array("error" => 1, "message" => "Hubo un problema con el registro")), 200);
        }
    }
}
