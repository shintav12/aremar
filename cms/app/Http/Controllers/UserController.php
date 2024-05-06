<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $active = "user";
    protected $parent = "user";

    protected $modelClass = UserModel::class;
    protected $repositoryClass = UserRepository::class;
    protected $title = "User";
    protected $index_template = "user.index";
    protected $edit_template = "user.edit";
    protected $create_template = "user.create";
    protected $metas_template = "user.metas";
}
