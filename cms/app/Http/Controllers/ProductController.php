<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CollectionsModel;
use App\Models\MetalsModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SectionModel;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $active = "products";
    protected $parent = "products";

    protected $modelClass = ProductModel::class;
    protected $repositoryClass = ProductRepository::class;
    protected $title = "Productos";
    protected $index_template = "products.index";
    protected $edit_template = "products.edit";
    protected $create_template = "products.create";

    public function create(){
        $categories = CategoryModel::get();
        $metals = MetalsModel::get();
        $collections = CollectionsModel::get();
        $sections = SectionModel::where('nav', 1)->get();
        $this->sub_title = "Crear";
        $this->setOptions();
        return $this->responseView($this->create_template,["categories" => $categories, "metals" => $metals, "sections" => $sections, "collections" => $collections]);
    }

    public function edit($id)
    {
        $this->data['model'] = $this->repository->find($id);
        $this->data['categories'] = CategoryModel::where('status',1)->get();
        $this->data['metals'] = MetalsModel::where('status',1)->get();
        $this->data['collections'] = CollectionsModel::where('status',1)->get();
        $this->data['sections'] = SectionModel::where(['nav'=> 1, 'status' => 1])->get();
        $this->data['images'] = ProductImageModel::where(['status' => 1,'product_id' => $id])->get();
        $this->sub_title = "Editar";
        $this->setOptions();
        return $this->responseView($this->edit_template,$this->data)->with('id',$id);
    }
}



