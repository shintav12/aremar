<?php

namespace App\Http\Controllers;

use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\UbigeoModel;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OrderDetail;

class OrderController extends Controller
{
    protected $active = "orders";
    protected $parent = "orders";

    protected $modelClass = OrderModel::class;
    protected $repositoryClass = OrderRepository::class;
    protected $title = "Ordenes";
    protected $index_template = "orders.index";
    protected $edit_template = "orders.edit";
    protected $create_template = "orders.create";

    public function edit($id)
    {
        $this->data['model'] = $this->repository->find($id);
        $this->data['order_details'] =
        OrderDetailModel::join('products','order_detail.product_id','=','products.id')
        ->join('metals','order_detail.metal_id','=','metals.id')
        ->join('collections','products.collection_id','=','collections.id')
        ->select('products.name', DB::raw('metals.name as metal_name'),'order_detail.price',DB::raw('collections.name as collection_name'))
        ->where('order_id',$id)->get();
        $distrito = UbigeoModel::where('ubigeo', $this->data['model']->ubigeo)->first();
        $provincia = UbigeoModel::where('ubigeo', substr($this->data['model']->ubigeo,0,4))->first();
        $departamento = UbigeoModel::where('ubigeo', substr($this->data['model']->ubigeo,0,2))->first();
        $address = $departamento->nombre.", ".$provincia->nombre.", ".$distrito->nombre;
        $this->sub_title = "Editar";
        $this->setOptions();
        return $this->responseView($this->edit_template,$this->data)->with('id',$id)->with('address', $address);
    }
}
