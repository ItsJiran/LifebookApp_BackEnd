<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\JWTokenController;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\View;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use DateTime;
use Carbon\Carbon;
use App\Models\Materials;
use App\Models\Journals;

class JournalsController extends Controller{

    public function updateHeader(Request $request, $id){
        try{

            $request->validate([
                'title' => ['required','string','max:255','min:6'],
                'date' => ['required'],
                'time' => ['required']
            ]);

            // i use d/m/Y because from the payload will have come from dateObject with toLocaleDateString method
            // why use toLocaleDateString because when i use with to utc or etc for some reason the day get subtracted so 
            // lead to inconsitent between what user input and what its get..
            $checkDate = DateTime::createFromFormat('Y-m-d',$request->date);
            if($checkDate == false) return response()->json(['errors'=>['date'=>'date not valid'],'message'=>'date not valid'],408);

            $time = $request->time . ':00';

            $user = auth('api')->user();
            $journal = Journals::where('id',$id)->first();
            
            if( is_null($journal) ) 
                return response()->json(['message'=>'Journal tidak ditemukan..'],404);
            if( $user->id !== $journal->user_id ) 
                return response()->json(['message'=>'Anda tidak mempunyai akses..'],403);

            $journal->title = $request->title;
            $journal->date = $request->date;
            $journal->time = $time;
            $journal->save();

            return response()->json(['message'=>'Berhasil mengubah header data..'],200);
        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);   
        }        
    }

    public function updateData(Request $request, $id){
        try{

            $request->validate([
                'editor_json' => ['required','string']
            ]);

            // if editor json were not json text
            if( !Str::isJson($request->editor_json) ) return response()->json(['message'=>'editor_json must be a json string'],408);

            $user = auth('api')->user();
            $journal = Journals::where('id',$id)->first();
            
            if( is_null($journal) ) 
                return response()->json(['message'=>'Journal tidak ditemukan..'],404);
            if( $user->id !== $journal->user_id ) 
                return response()->json(['message'=>'Anda tidak mempunyai akses..'],403);

            $journal->data = $request->editor_json;
            $journal->save();

            return response()->json(['message'=>'Berhasil mengubah header data..'],200);
        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);   
        }        
    }

    public function view(Request $request, $id){
        try{

            $user = auth('api')->user();
            $journal = Journals::where('id',$id)->first();
            
            if( is_null($journal) ) 
                return response()->json(['message'=>'Journal tidak ditemukan..'],404);

            if( $user->id !== $journal->user_id ) 
                return response()->json(['message'=>'Anda tidak mempunyai akses..'],403);

            // hh:mm:ss -> hh:mm because browser time input use hh:mm
            $split = explode( ':', $journal->time );
            $journal->time = $split[0] . ':' . $split[1];

            return response()->json($journal,200);
        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);   
        }
    }

    public function query(Request $request){
        try{
            $selected_query = ['id','user_id','title','date','time'];
            $search_query = $request->query('q');
            $user = auth('api')->user();
            
            // default search
            if(is_null($search_query)){
                $query = Journals::select($selected_query)
                ->where('user_id',$user->id)
                ->get();
            } else {
                $query = Journals::select($selected_query)
                ->where([
                    ['user_id','=',$user->id],
                    ['title','LIKE','%'.$search_query.'%'],
                ])->get();
            }
            

            return response()->json($query,200);
        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
        }
    }

    public function queryFullDate(Request $request, $year, $month, $day){
        try{
            $selected_query = ['id','user_id','title','date','time'];
            $user = auth('api')->user();

            if( !checkdate( $month, $day, $year ) ) 
                return response()->json(['message'=>'date not valid'],408);

            // default search
            $query = Journals::select($selected_query)
            ->where([
                ['user_id','=',$user->id],
                ['date','=',$year . '-' . $month . '-' . $day],
            ])->get();
          

            return response()->json($query,200);
        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
        }
    }

    public function destroy(Request $request,$id){
        try{

            $target = Journals::where('id',$id)->first();
            
            if(is_null($target)) return response()->json(['message'=>'Data Not Found'],404);

            if($target->user_id !== auth('api')->user()->id) return response()->json(['errors'=>[$e],'message'=>'Tidak dapat menghapus milik orang lain'],403);

            Journals::where('id',$request->id)->delete();

            return response()->json(['message'=>'Delete success'],200);

        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
        }        
    }

    public function store(Request $request){
        try{

            $request->validate([
                'title' => ['required','string','max:255','min:6'],
                'date' => ['required'],
                'time' => ['required'],
                'editor_json' => ['required','string']
            ]);

            // if editor json were not json text
            if( !Str::isJson($request->editor_json) ) return response()->json(['message'=>'editor_json must be a json string'],408);
    
            // i use d/m/Y because from the payload will have come from dateObject with toLocaleDateString method
            // why use toLocaleDateString because when i use with to utc or etc for some reason the day get subtracted so 
            // lead to inconsitent between what user input and what its get..
            $checkDate = DateTime::createFromFormat('Y-m-d',$request->date);
            if($checkDate == false) return response()->json(['errors'=>['date'=>'date not valid'],'message'=>'date not valid'],408);

            $time = $request->time . ':00';

            // inserting to database
            $user = auth('api')->user();
            Journals::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'date' => $request->date,
                'time' => $time,
                'data' => $request->editor_json,
            ]);
    
            return response()->json(['message'=>'Upload success'],200);

        } catch(\Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
        }
    }

}