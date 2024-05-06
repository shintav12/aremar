<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\Sections;
use Illuminate\Http\Request;
use Mockery\Exception;

class SectionController extends ApiController
{
    public function getSections(){
        try{
            $sections = Sections::getSections();
            return json_encode(['error' => 0, 'data' => $sections]);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }

    public function getSectionBySlug($slug){
        try{
            $sections = Sections::getSectionBySlug($slug);
            return json_encode(['error' => 0, 'data' => $sections]);
        }catch(Exception $e){
            return json_encode(['error' => 1, 'message' => $e]);
        }
    }
}
