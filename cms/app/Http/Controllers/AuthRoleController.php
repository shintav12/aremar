<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Models\AuthRole;
use App\Repository\AuhtRoleRepository;
use \Request;
/**
 * Description of AuthRoleController
 *
 * @author Luis
 */
class AuthRoleController extends Controller{

    protected $active = "auth_role";
    protected $parent = "auth_role";

    protected $modelClass =AuthRole::class;
    protected $repositoryClass = AuhtRoleRepository ::class;
    protected $index_template = 'auth_role.index';
    protected $title = "Roles";
    
    public function perms($id){
        $perms = $this->repository->perms($id);
        return $this->responseView("perms",["items"=>$perms])->with("id",$id);
    }

    public function permissionsSave() {
    	$this->repository->save_perms(Request::all());
    	return $this->responseJSON("");
    }
    
}
