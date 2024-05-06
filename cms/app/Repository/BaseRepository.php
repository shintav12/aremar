<?php
namespace App\Repository;

use App\Models\BaseModel;
use App\Models\Metas;
use App\Utils\imageUploader;
use App\Localization\LocalizationInterface;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository{
    public const MODEL_CLASS = BaseModel::class;
    /** @var BaseModel */
    protected $model;
    protected $path;


    public function __construct()
    {
        $modelClass = static::MODEL_CLASS;
        $this->model = new $modelClass();
        $this->path = $this->model->getTable();
    }

    public function datatableView()
    {
        return $this->model->datatable();
    }

    public function datatable()
    {
        return $this->model
            ->select($this->model->datatable());
    }

    public function change_status($id, $status)
    {
        $data = ['status' => $status];
        $this->model->where(['id' => $id])->update($data);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getParentRepository()
    {
        return null;
    }

    public function detail($id)
    {
        return $this->model->whereKey($id);
    }

    public function all()
    {
    }

    public function find($id)
    {

        return  $this->model->findOrFail($id);

    }


    public function create(array $data,$type)
    {

        return DB::transaction(function () use ($data,$type) {
            return $this->_create($data,$type);
        });
    }

    public function update(array $data, $id)
    {

        $resource = $this->model->findOrFail($id);
        return DB::transaction(function () use ($data, $resource) {
            return $this->_update($data, $resource);
        });
    }

    public function getTableColumnAndTypeList(){
        return $this->model->getTableColumnAndTypeList();
    }

    public function delete($id)
    {
        $this->model->where("id",$id)->update(["status"=>2]);
    }

    public function restore($id)
    {
        $this->model->where(array("id"=>$id))->update(["status"=>1]);
    }

    public function reorder($values)
    {
        $array = json_decode($values["values"]);
        for($i=0;$i<count($array);$i++){
            $oldEntity = $this->model->find($array[$i][0]);
            $newEntity = $this->model->find($array[$i][1]);
            $oldEntity->moveAfter($newEntity);
        }
        return "";
    }

    protected function _create(array $data,$type)
    {
        $fillable = $this->model->fillable;
        $insert = [];
        foreach ($fillable as $key => $value) {
            if(array_key_exists($value, $data)){
                $insert[$value] = $data[$value];
            }
        }
        if(in_array("created_by", $fillable)){
            $insert["created_by"] = 1;
        }

        if ($this->model instanceof LocalizationInterface) {

        } else {
            $model = $this->model->create($insert);
        }
        $this->_updateImage($data,$model);
        $this->_createImages($data,$model);

        if(array_key_exists("meta_title",$data)){
            $this->create_metas($data,$type,$model);
        }

        return "";
    }

    protected function _updateImage($data,$resource){
        if(array_key_exists("path", $data) && ($data["path"] != null)){
            $path = imageUploader::upload($resource, $data["path"], $this->path,"",config("app.path_archive"));
            $resource->update([
                "path"=>$path
            ]);
        }
    }

    protected function upload($resource,$file,$path,$type=""){
        return imageUploader::upload($resource, $file, $path,$type,config("app.path_archive"));
    }

    protected function _update(array $data, $resource)
    {
        if ($this->model instanceof LocalizationInterface) {
            $localizations = $data['localizations'];
            unset($data['localizations']);
            $dbLocalizations = $resource->localizations->keyBy('id');

            $locClass = $resource::LOCALIZATION_CLASS;
            $locFields = $resource->getLocalizationFields();
            foreach ($localizations as $localization) {
                if ($localization['id'] && isset($dbLocalizations[$localization['id']])) {
                    $dbLocalizations[$localization['id']]->update($localization);
                } else {
                    $loc = new $locClass();
                    foreach ($locFields as $column) {
                        $loc->{$column} = $localization[$column];
                    }
                    $loc->language_id = $localization['language_id'];
                    $loc->save();
                }
            }
        }
        $fillable = $this->model->fillable;

        foreach ($fillable as $key => $value) {
            if(array_key_exists($value, $data)){
                $update[$value] = $data[$value];
            }
        }
        if(in_array("updated_by", $fillable)){
            $update["updated_by"] = 1;
        }
        $resource->update($update);
        $this->_updateImage($data,$resource);
        $this->_createImages($data,$resource);
    }

    protected function _createImages($images,$resource){

    }

    public function create_metas($data,$type,$model){

      try {
        DB::beginTransaction();
           $resource = Metas::create([
               "object_id"=>$model->id,
               "type"=>$type,
                "meta_title"=>$data["meta_title"],
                "meta_description"=>$data["meta_description"],
                "meta_keywords"=>$data["meta_keywords"],
                "fb_title"=>$data["fb_title"],
                "fb_description"=>$data["fb_description"],
                "tw_title"=>$data["tw_title"],
                "tw_description"=>$data["tw_description"],
                "meta_index"=>array_key_exists("meta_index",$data) ? 1 : 0,
                "meta_follow"=>array_key_exists("meta_follow",$data) ? 1 : 0,
            ]);

        if(array_key_exists("path_metas",$data)){
            $path = imageUploader::upload($resource, $data["path_metas"],"Metas","",config("app.path_archive"));
                $resource->update([
                    "path"=>$path
                ]);
        }
        DB::commit();
        return "";
      } catch (\Exception $e) {

          DB::Rollback();
          return "ERROR".$e->getLine();
      }
    }

    public function updated_metas($data,$id,$type){

      $resource = Metas::where(["object_id"=>$id,"type"=>$type])->first();
      try {
        DB::beginTransaction();
        $resource->update([
            "meta_title"=>$data["meta_title"],
            "meta_description"=>$data["meta_description"],
            "meta_keywords"=>$data["meta_keywords"],
            "fb_title"=>$data["fb_title"],
            "fb_description"=>$data["fb_description"],
            "tw_title"=>$data["tw_title"],
            "tw_description"=>$data["tw_description"],
            "meta_index"=>array_key_exists("meta_index",$data) ? 1 : 0,
            "meta_follow"=>array_key_exists("meta_follow",$data) ? 1 : 0,
        ]);

        if(array_key_exists("path_metas",$data)){
            $path = imageUploader::upload($resource, $data["path_metas"],"Metas","",config("app.path_archive"));
                $resource->update([
                    "path"=>$path
                ]);
        }
        DB::commit();
        return "";
      } catch (\Exception $e) {

          DB::Rollback();
          return "ERROR".$e->getLine();
      }
    }

    public function get_metas($type,$id){
      $metas =  Metas::where(["object_id"=>$id,"type"=>$type])->first();
      return $metas;
    }

}

?>
