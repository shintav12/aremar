<?php

namespace App\Models\api;

use App\Models\SectionModel;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    public static function getSections(){
        return SectionModel::where(['status'=> 1])->orderBy('position')->get(['name', 'slug']);
    }
    public static function getSectionBySlug($slug){
        return SectionModel::where(['status'=> 1, 'slug' => $slug])->orderBy('position')->get(['name', 'title','slug', 'path'])->first();
    }
}
