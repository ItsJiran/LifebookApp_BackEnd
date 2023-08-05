<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Materials;

class MaterialsController extends Controller
{

    public function post(Request $request){

        $request->validate([
            'name' => ['required','min:6'],
            'date' => ['required'],
            'file' => ['required','mimes:pdf'],
        ]);



        exit();
    }
    public function create(Request $request){
        return view('home_add_material');
    }



}
