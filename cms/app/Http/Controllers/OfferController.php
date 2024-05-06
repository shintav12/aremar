<?php

namespace App\Http\Controllers;

use App\Models\OfferModel;
use App\Models\ProductModel;
use App\Repository\OfferRepository;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    protected $active = "offers";
    protected $parent = "offers";

    protected $modelClass = OfferModel::class;
    protected $repositoryClass = OfferRepository::class;
    protected $title = "Ofertas";
    protected $index_template = "offers.index";
    protected $edit_template = "offers.edit";
    protected $create_template = "offers.create";

    public function create(){
        $products = ProductModel::get();
        $this->sub_title = "Crear";
        $this->setOptions();
        return $this->responseView($this->create_template,["products" => $products]);
    }

    public function edit($id)
    {
        $this->data['model'] = $this->repository->find($id);
        $this->data['products'] = ProductModel::get();
        $this->sub_title = "Editar";
        $this->setOptions();
        return $this->responseView($this->edit_template,$this->data)->with('id',$id);
    }
}
