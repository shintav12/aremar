<?php

namespace App\Http\Controllers;

use App\Models\SectionModel;
use App\Repository\SectionRepository;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    protected $active = "sections";
    protected $parent = "sections";

    protected $modelClass = SectionModel::class;
    protected $repositoryClass = SectionRepository::class;
    protected $title = "Secciones";
    protected $index_template = "sections.index";
    protected $edit_template = "sections.edit";
    protected $create_template = "sections.create";
}
