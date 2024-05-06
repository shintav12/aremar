<?php

namespace App\Http\Controllers;

use App\Models\MetalsModel;
use App\Repository\MetalsRepository;
use Illuminate\Http\Request;

class MetalsController extends Controller
{
    protected $active = "metals";
    protected $parent = "metals";

    protected $modelClass = MetalsModel::class;
    protected $repositoryClass = MetalsRepository::class;
    protected $title = "Tipos de Metales";
    protected $index_template = "metals.index";
    protected $edit_template = "metals.edit";
    protected $create_template = "metals.create";
}
