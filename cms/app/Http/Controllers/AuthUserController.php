<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Models\AuthUser;
use App\Repository\AuthUserRepository;

/**
 * Description of AuthUserController
 *
 * @author Luis
 */
class AuthUserController extends Controller{

    protected $active = "auth_user";
    protected $parent = "auth_role";

    protected $modelClass =AuthUser::class;
    protected $repositoryClass = AuthUserRepository::class;
    protected $title = "Usuarios";
    protected $index_template = "auth_user.index";
    protected $edit_template = "auth_user.edit";
    protected $create_template = "auth_user.create";
    
    
    protected function setOptions() {
        $this->options["roles"] = \App\Models\AuthRole::get(["id","name"]);
     }
    
}
