<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\Categories;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Mockery\Exception;

class CategoriesController extends ApiController
{
    public function getCategories(){
        try{
            $categories = Categories::getCategories();
            return json_encode(['error' => 0, 'data' => $categories]);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }

    public function getCategoryBySlug($slug){
        try{
            $categories = Categories::getCategoriesBySlug($slug);
            return json_encode(['error' => 0, 'data' => $categories]);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }
}
