<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $active = "categories";
    protected $parent = "categories";

    protected $modelClass = CategoryModel::class;
    protected $repositoryClass = CategoryRepository::class;
    protected $title = "Categorias";
    protected $index_template = "category.index";
    protected $edit_template = "category.edit";
    protected $create_template = "category.create";
}
