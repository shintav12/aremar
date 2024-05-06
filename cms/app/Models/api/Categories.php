<?php

namespace App\Models\api;

use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public static function getCategories(){
        return CategoryModel::where(['status'=> 1])->orderBy('position')->get(['name', 'slug']);
    }
    public static function getCategoriesBySlug($slug){
        return CategoryModel::where(['status'=> 1, 'slug' => $slug])->orderBy('position')->first(['name', 'slug']);
    }
}
