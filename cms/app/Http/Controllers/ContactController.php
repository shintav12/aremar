<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Repository\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $active = "contacts";
    protected $parent = "contacts";

    protected $modelClass = ContactModel::class;
    protected $repositoryClass = ContactRepository::class;
    protected $title = "contacts";
    protected $index_template = "contacts.index";
    protected $edit_template = "contacts.edit";
    protected $create_template = "contacts.create";
}
