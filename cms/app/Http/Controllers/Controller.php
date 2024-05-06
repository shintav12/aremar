<?php
namespace App\Http\Controllers;
use App\Models\BaseModel;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use \Session;
use App\Repository\AuthUserRepository;
use Exception;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Luis
 */
class Controller {

    protected $parent = "";
    protected $active = "";
    protected $title = "";
    protected $sub_title = "";
    protected $route_parent = "";
    protected $options = [];

    protected $model;
    protected $modelClass = BaseModel::class;
    protected $templateDir = 'templates';
    protected $repositoryClass = BaseRepository::class;
    protected $repository;
    protected $edit_template = "edit";
    protected $create_template = "create";
    protected $index_template = "index";
    protected $metas_template = "metas";
    protected $allow_creation = true;

     public function __construct()
    {
        assert(!empty($this->templateDir), new Exception(static::class . '::$templateDir can\'t be empty'));

        $this->data = [];

        $this->model = app($this->modelClass);
        $this->active = $this->model->getTable();
        $this->repository = app($this->repositoryClass);
        $this->routes = ["create"=>$this->model->getTable().'_create',
                         "edit"=>$this->model->getTable().'_edit',
                         "store"=>$this->model->getTable().'_store',
                         "update"=>$this->model->getTable().'_update',
                         "status"=>$this->model->getTable()."_status",
                         "datatable"=>$this->model->getTable()."_datatable",
                         "delete"=>$this->model->getTable()."_delete",
                         "seo"=>$this->model->getTable()."_seo",
                         "update_seo"=>$this->model->getTable()."_update_seo",
                         "reorder"=>$this->model->getTable()."_reorder",
                         "list"=>$this->model->getTable()];
    }


     public function change_status(Request $request){
        $data = $request->all();
        $id = $data["id"];
        $status = $data["status"];
        $response = $this->repository->change_status($id,$status);
        return $response == "" ? $this->responseJSON() : $this->responseJSON($response);
    }

    public function index(){

        $this->sub_title = "Listado";
        return $this->responseView($this->index_template);
    }


    public function create(){
        $this->sub_title = "Crear";
        $this->setOptions();
        return $this->responseView($this->create_template);
    }

    public function store(Request $request){
        $response = $this->repository->create($request->all(), $this->active);
        return $response == "" ? $this->responseJSON() : $this->responseJSON($response);
    }

    public function update(Request $request, $id){
        $response = $this->repository->update($request->all(),$id);
        return $response == "" ? $this->responseJSON() : $this->responseJSON($response);
    }

    public function datatable(){
        return \Yajra\DataTables\Facades\DataTables::of($this->repository->datatable())
            ->make(true);
    }

    protected function convert_to_datatable($result){
        return \Yajra\DataTables\Facades\DataTables::of($result)
            ->make(true);
    }

    public function edit($id)
    {
        $this->data['model'] = $this->repository->find($id);
        $this->sub_title = "Editar";
        $this->setOptions();
        return $this->responseView($this->edit_template,$this->data)->with('id',$id);
    }

    protected function setOptions(){

    }

    protected function responseView($route,$data = []){
        $perms = Session::get("user")->permissions;
        $page_data = [
            'parent' => $this->parent,
            'active' => $this->active,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            "routes"=>$this->routes,
            "options"=>$this->options,
            "permissions"=>$perms,
            "columns"=>$this->repository->datatableView(),
            "allow_creation"=>$this->allow_creation,
            "columns_types"=>$this->sub_title != "Listado" ? $this->repository->getTableColumnAndTypeList() : array(),
            'data' => $data
        ];
        $path = sprintf("%s/%s",$this->templateDir,$route);
        return view($this->route_parent.".".$path,$page_data);
    }

    protected function responseJSON($error = "",$data = []){
        return response()->json([
            'error' => $error,
            'code' => $error ? 1 : 0,
            'data' => $data
        ]);
    }

    public function delete(Request $request){
        $data = $request->all();
        $id = $data["id"];
        $response = $this->repository->delete($id);
        return $response == "" ? $this->responseJSON() : $this->responseJSON($response);
    }

    public function reorder(Request $request){
        $response = $this->repository->reorder($request->all());
        return $response == "" ? $this->responseJSON() : $this->responseJSON($response);
    }

    public function updated_metas(Request $request,$id){
        $response = $this->repository->updated_metas($request->all(),$id,$this->active);
        return $response == "" ? $this->responseJSON() : $this->responseJSON($response);
    }

    public function get_metas(Request $request,$id){
        $this->data['model'] = $this->repository->get_metas($this->active,$id);
        $this->sub_title = "Editar";
        $this->setOptions();
        return $this->responseView($this->metas_template,$this->data)->with('id',$id);
    }
}
