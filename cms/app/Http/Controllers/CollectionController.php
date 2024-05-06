<?php

namespace App\Http\Controllers;

use App\Models\CollectionsModel;
use App\Repository\CollectionRepository;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    protected $active = "collections";
    protected $parent = "collections";

    protected $modelClass = CollectionsModel::class;
    protected $repositoryClass = CollectionRepository::class;
    protected $title = "Colecciones";
    protected $index_template = "collections.index";
    protected $edit_template = "collections.edit";
    protected $create_template = "collections.create";
}
