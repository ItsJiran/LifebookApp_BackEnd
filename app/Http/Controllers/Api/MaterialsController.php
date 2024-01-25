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

use Carbon\Carbon;
use App\Models\Materials;

class MaterialsController extends Controller{
    
    public function storage():string{
        return '/storage/materials';
    }

    public function store(Request $request){

        $request->validate([
            'title' => ['required','string','max:255','min:6'],
            'files' => ['required'],
            'date' => ['required','date'],
            'time' => ['required']
        ]);

        try{
        
            if($request->file('files')[0]->getMimeType() !== 'application/pdf'){
                return response()->json(['errors'=>['files'=>['The file must be a type of pdf']],'message'=>'File must be a file with type pdf'],422);    
            }
          
            // 
            $carbon = Carbon::parse($request->date)->setTimezone('UTC');
            $format = $carbon->format('Y-m-d') . ' ' . $request->time . ':00'; 

            $path = Storage::disk('public')->put( $this->storage(), $request->file('files')[0] );
            if($path == false) throw new Exception("Storage can't write the file"); 
    
            Materials::create([
                'title' => $request->title,
                'path' => '/public/'.$path,
                'date' => $format,
            ]);

            return response()->json(['message'=>'Berhasil menambahkan data material'],200);
        } catch(Exception $e) {
            return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
        }
    }

    public function view(Request $request, $id){
        try{
            $material = Materials::where('id',$id)->first();
            $path = str_replace('/public/','',$material->path);
            
            $file_exist = Storage::disk('public')->exists($path);

            if(!$file_exist){
                return response()->json(['message'=>'File tidak ditemukan'],404);
            } 

            $file = Storage::disk('public')->get($path);

            $headers = [
                'Content-Description' => 'File Transfer',
                'Content-Type' => 'application/pdf',
            ];

            return Storage::disk('public')->download($path,$material->title);
        } catch (Exception $e) {
            return response()->json(['errors'=>[$e], 'message'=>'Terjadi kesalahan dalam server'],500);
        }

    }

    public function query(Request $request){
        $materials = Materials::orderBy('date','desc')->get();
        return $materials;
    }

    public function destroy(Request $request){
        return '';
    }

    // private function splitDateTime($dateTime){
    //     // expected : yyyy-mm-dd hh:ii:ss
    //     $split = explode(' ',$dateTime); 
                    
    //     $date = explode('-',$split[0]);

    //     $date_obj = [
    //         'year'=>$date[0],
    //         'month'=>$date[1],
    //         'day'=>$date[2],
    //     ];

    //     $time = explode(':',$split[1]);
    //     $time_obj = [
    //         'hour'=>$time[0],
    //         'minute'=>$time[1],
    //         'second'=>$time[2],
    //     ];

    //     return [
    //         'time'=>$time_obj,
    //         'date'=>$date_obj
    //     ];
    // }
}
