<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $active = "newsletters";
    protected $parent = "newsletters";

    protected $modelClass = NewsletterMailModel::class;
    protected $repositoryClass = NewsletterMailRepository::class;
    protected $title = "Newsletter - Correos Registrados";
    protected $index_template = "newsletter_mails.index";
}
