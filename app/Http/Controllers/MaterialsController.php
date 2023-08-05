<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Materials;

class MaterialsController extends Controller
{

    public function storage():string{
        return '/storage/materials';
    }

    public function post(Request $request){
        $request->validate([
            'title' => ['required','min:6'],
            'date' => ['required'],
            'file' => ['required','mimes:pdf,doc,docx'],
        ]);

        $path = Storage::disk('public')->put( $this->storage(), $request->file );

        Materials::create([
            'title' => $request->title,
            'path' => '/public/'.$path,
            'date' => $request->date,
        ]);

        return redirect('home');
    }
    public function create(Request $request){
        return view('home_add_material');
    }

    public function view($id){
        $material = Materials::where('id',$id)->first();
        return view('materials_view',compact('material'));
    }
}
