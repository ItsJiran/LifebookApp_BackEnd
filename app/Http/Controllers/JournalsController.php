<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Journalss;

class JournalsController extends Controller
{

    public function storage():string{
        return '/storage/materials';
    }

    public function post(Request $request){
        return redirect('home');
    }

    public function create(Request $request){
        return view('journal_add');
    }

    public function edit(Request $request){
        return view('journal_edit');
    }
}
