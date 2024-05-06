<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\SectionModel;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function view(){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $vitrina = SectionModel::where('id', 8)->first();
        $user = session('user');
        $template = [
            'sections' => $sections,
            'vitrina' =>$vitrina,
            'user' => $user
        ];
        return view('pages.contact', $template);
    }

    public function us(){
        $sections = SectionModel::where(['status' => 1, 'nav' => 1])->orderBy('position')->get(['name', 'slug']);
        $vitrina = SectionModel::where('id', 2)->first();
        $user = session('user');
        $template = [
            'sections' => $sections,
            'vitrina' =>$vitrina,
            'user' => $user
        ];
        return view('pages.us', $template);
    }

    public function contact(Request $request){
        try {

            $contact = new ContactModel();
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->message = $request->input('message');
            $contact->save();

            return response(json_encode(array("error" => 0, "id" => "")), 200);

        } catch (Exception $exception) {
            return response(json_encode(array("error" => 1, "message" => "Hubo un problema con el registro")), 200);
        }
    }


}
