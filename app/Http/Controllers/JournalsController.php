<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Journals;

class JournalsController extends Controller
{

    public function storage():string{
        return '/storage/materials';
    }

    public function post(Request $request){
        $request->validate([
            'title'=> ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'editor_data' => ['required'],
        ]);

        Journals::create([
            'user_id' => $request->session()->get('user_id'),
            'title' => $request->title,
            'date'  => $request->date,
            'time'  => $request->time,
            'data'  => json_encode( $request->editor_data ),
        ]);

        return response()->json(['success'=>'success','message'=>'Berhasil menambahkan'],200);
    }
    public function update(Request $request){
        $request->validate([
            'id'          => ['required'],
            'editor_data' => ['required'],
        ]);

        $journal = Journals::where('id',$request->id)->first();
        if($journal->user_id !== $request->session()->get('user_id')) return response()->json(['error'=>'error','message'=>'Gagal melakukan perubahan'],400);

        $journal->data = json_encode($request->editor_data);
        $journal->save();

        return response()->json(['success'=>'success','message'=>'Berhasil melakukan perubahan'],200);
    }

    public function create(Request $request){
        return view('journal_add');
    }
    public function edit(Request $request,$id){
        $journal = Journals::where('id',$id)->first();

        if($journal->user_id !== $request->session()->get('user_id'))
            return redirect('home');

        return view('journal_edit',compact('journal'));
    }
    public function delete(Request $request, $id){
        $journal = Journals::where('id',$id)->first();

        if($journal->user_id !== $request->session()->get('user_id'))
            return redirect('home');

        $journal->delete();
        return redirect('home');
    }
}
