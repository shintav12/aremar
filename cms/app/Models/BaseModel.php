<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use \Session;
use \DB;

class BaseModel extends Model
{   
    protected $exclude = ["id","status","created_at","updated_at","created_by","updated_by"];
    public $images = null;
    public static $localizationFields = [];
    
	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public static function slugify($title){
        $title=strtr(utf8_decode($title), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        $slug = trim($title);
        $slug = preg_replace('/[^a-zA-Z0-9 -]/', '', $slug); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug = str_replace(' ', '-', $slug); // replace spaces by dashes
        $slug = strtolower($slug);  // make it lowercase
        return $slug;
    }

    public static function get_slug($field, $table){
        $slug = self::slugify($field);
        $query = "select id from `" . $table . "` where slug REGEXP '^{$slug}(-[0-9]*)?$'";
        $slugCount = count(DB::select($query));
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

    public static function get_slug_id($field,$table,$id){
        $slug = self::slugify($field);
        $query = "select id from `" . $table . "` where id !=$id and slug REGEXP '^{$slug}(-[0-9]*)?$'";
        $slugCount = count(DB::select($query));
        return ($slugCount > 0) ? "{$field}-{$slugCount}" : $slug;
    }

    protected function setCreatedByAttribute(){
        $user = Session::get('user');
        if(!is_null($user)){
            $this->attributes['created_by'] = Session::get('user')->id;
        }
    }

    protected function setUpdatedByAttribute(){
        $user = Session::get('user');
        if(!is_null($user)){
            $this->attributes['updated_by'] = Session::get('user')->id;
        }
    } 

    public function datatable(){
        $created = ["created_by","updated_by"];
        $diff = array_diff($this->fillable, $created);
        return $diff;
    }

    public function getTableColumnAndTypeList($fullType = false){
        $fieldAndTypeList = [];
        $tableName = $this->getTable();
        foreach (DB::select( "describe $tableName")  as $field){
            $type = ($fullType || !str_contains($field->Type, '('))? $field->Type: substr($field->Type, 0, strpos($field->Type, '('));
            if(!in_array($field->Field, $this->exclude)){
            	$fieldAndTypeList[$field->Field] = $type;	
            }
        }
        return $fieldAndTypeList;
    }

}