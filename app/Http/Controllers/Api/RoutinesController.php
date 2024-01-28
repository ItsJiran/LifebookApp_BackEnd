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

use App\Models\RoutinesLogs;
use App\Models\RoutinesIcons;
use App\Models\RoutinesTypes;
use App\Models\RoutinesPeriods;
use App\Models\Routines;

class RoutinesController extends Controller{

   public function getIcons(){
      return response()->json(RoutinesIcons::orderBy('id','asc')->get());
   }

   public function queryMonth(Request $request,$id,$year,$month){
      try{
         $carbon = Carbon::createFromDate($year, $month);     
         
         $start = $carbon->startOfMonth()->format('Y-m-d');
         $last = $carbon->endOfMonth()->format('Y-m-d');     

         $routine = Routines::where('id',$id)->first();         
   
         if( is_null($routine) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);
   
         if($routine->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat menambah milik orang lain'],403);
         
         $target = RoutinesLogs::where([
            ['routines_id','=',$id], 
            ['date','>=',$start],
            ['date','<=',$last]
         ])->orderBy('date','asc')->get();

         $json = [];

         foreach ($target as $key => $value) {
            $json[$value->date] = $value;

            $percentage = $json[$value->date]->val / $routine->max_val * 100;
            $json[$value->date]->circle = $percentage * (2 * 40 * 3.14) / 100;            
         }

         return response()->json($json,200);
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }              
   }

   public function minus(Request $request, $id, $year, $month, $day){
      try{
         $carbon = Carbon::createFromDate($year, $month, $day);         

         $routine = Routines::where('id',$id)->first();
         $target = RoutinesLogs::where(['routines_id'=>$id, 'date'=>$carbon->format('Y-m-d')])->first();
   
         if( is_null($routine) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);
   
         if($routine->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat menambah milik orang lain'],403);

         if($target !== null){

            if($target->val > 0) {
               $target->val -= 1;
               $target->save();

               $new_data = $target;

               $percentage = $target->val / $routine->max_val * 100;
               $target->circle = $percentage * (2 * 40 * 3.14) / 100;  

               return response()->json(['message'=>'berhasil mengurangi data','new_data'=>$new_data],200);
            } else if ($target->val == 0) {               
               $target->delete();
               return response()->json(['message'=>'berhasil mengurangi data','new_data'=>'removed'],200);
            }         

         } else {
            return response()->json(['message'=>'request berhasil namun data tidak ditemukan'],200);
         }

      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }     
   }

   public function plus(Request $request, $id, $year, $month, $day){
      try{
         $carbon = Carbon::createFromDate($year, $month, $day);         

         $routine = Routines::where('id',$id)->first();
         $target = RoutinesLogs::where(['routines_id'=>$id, 'date'=>$carbon->format('Y-m-d')])->first();         

         if( is_null($routine) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);
   
         if($routine->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat menambah milik orang lain'],403);

         if($target == null){

            $new_data = RoutinesLogs::create([
               'user_id'     => $routine->user_id,
               'routines_id' => $routine->id,
               'val' => 0,
               'date' => $carbon->format('Y-m-d')
            ]);

            $new_data->save();

            $percentage = $new_data->val / $routine->max_val * 100;
            $new_data->circle = $percentage * (2 * 40 * 3.14) / 100;  

         } else {
            
            if($target->val < $routine->max_val) {
               $target->val += 1;
               $target->save();

               $percentage = $target->val / $routine->max_val * 100;
               $target->circle = $percentage * (2 * 40 * 3.14) / 100;  

               $new_data = $target;
            } else {
               $percentage = $target->val / $routine->max_val * 100;
               $target->circle = $percentage * (2 * 40 * 3.14) / 100;  
               return response()->json(['message'=>'berhasil menambahkan data, namun sudah maksimal','new_data'=>$target],200);               
            }

         }

         return response()->json(['message'=>'berhasil menambahkan data','new_data'=>$new_data],200);
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }     
   }

   public function remove(Request $request, $id, $year, $month, $day){
      try{
         $carbon = Carbon::createFromDate($year, $month, $day);         

         $routine = Routines::where('id',$id)->first();
         $target = RoutinesLogs::where(['routines_id'=>$id, 'date'=>$carbon->format('Y-m-d')])->first();
   
         if( is_null($routine) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);
   
         if($routine->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat menambah milik orang lain'],403);

         if($target !== null){

            $target->delete();
            return response()->json(['message'=>'berhasil mengurangi data','new_data'=>'removed'],200);

         } else {
            return response()->json(['message'=>'request berhasil diterima namun data tidak ditemukan','new_data'=>'removed'],200);
         }
         
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }     
   }

   public function done(Request $request, $id, $year, $month, $day){
      try{
         $carbon = Carbon::createFromDate($year, $month, $day);         

         $routine = Routines::where('id',$id)->first();
         $target = RoutinesLogs::where(['routines_id'=>$id, 'date'=>$carbon->format('Y-m-d')])->first();
   
         if( is_null($routine) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);
   
         if($routine->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat menambah milik orang lain'],403);

         if($target == null){

            $new_data = RoutinesLogs::create([
               'user_id'     => $routine->user_id,
               'routines_id' => $routine->id,
               'val' => $routine->max_val,
               'date' => $carbon->format('Y-m-d')
            ]);

            $new_data->save();

         } else {
            $target->val = $routine->max_val;
            $target->save();

            $new_data = $target;            
         }

         $percentage = $new_data->val / $routine->max_val * 100;
         $new_data->circle = $percentage * (2 * 40 * 3.14) / 100;  

         return response()->json(['message'=>'berhasil menambahkan data','new_data'=>$new_data],200);
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }     
   }

   public function undone(Request $request, $id, $year, $month, $day){
      try{
         $carbon = Carbon::createFromDate($year, $month, $day);         

         $routine = Routines::where('id',$id)->first();
         $target = RoutinesLogs::where(['routines_id'=>$id, 'date'=>$carbon->format('Y-m-d')])->first();
   
         if( is_null($routine) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);
   
         if($routine->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat menambah milik orang lain'],403);

         if($target == null){

            $new_data = RoutinesLogs::create([
               'user_id'     => $routine->user_id,
               'routines_id' => $routine->id,
               'val' => 0,
               'date' => $carbon->format('Y-m-d')
            ]);

            $new_data->save();

         } else {
            $target->val = 0;
            $target->save();

            $new_data = $target;            
         }

         $percentage = $new_data->val / $routine->max_val * 100;
         $new_data->circle = $percentage * (2 * 40 * 3.14) / 100;  

         return response()->json(['message'=>'berhasil menambahkan data','new_data'=>$new_data],200);
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }     
   }

   public function info(Request $request, $id){ 
      try{      
         $target = Routines::where('id',$id)->first();

         if( is_null($target) ) 
            return response()->json(['message'=>'Rutinitas tidak ditemukan..'],404);

         if($target->user_id !== auth('api')->user()->id) 
            return response()->json(['message'=>'Tidak dapat melihat milik orang lain'],403);

         $icon = RoutinesIcons::select(['title'])->where('id',$target->icon_id)->first();
         
         $type = RoutinesTypes::select(['title'])->where('id',$target->type_id)->first();

         $selected_field = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',  
         ];
         $period = RoutinesPeriods::select($selected_field)->where('routines_id',$target->id)->first();

         $target->period = $period;
         $target->type = $type->title;         
         $target->icon = $icon->title;

         return response()->json($target,200);
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
     }  
   }

   public function destroy(Request $request, $id){
      try{

         $target = Routines::where('id',$id)->first();
         
         if(is_null($target)) return response()->json(['message'=>'Data Not Found'],404);
         if($target->user_id !== auth('api')->user()->id) return response()->json(['message'=>'Tidak dapat menghapus milik orang lain'],403);

         RoutinesLogs::where('routines_id',$id)->delete();
         RoutinesPeriods::where('routines_id',$id)->delete();
         Routines::where('id',$id)->delete();

         return response()->json(['message'=>'Delete success'],200);
     } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
     }        
   }

   public function query(Request $request){
      try{

         $icons = RoutinesIcons::get();
         $selected_query = ['id','user_id','title','icon_id','filter_color','color'];
         $search_query = $request->query('q');
         $user = auth('api')->user();
         
         // default search
         if(is_null($search_query)){
            $query = Routines::select($selected_query)
            ->where('user_id',$user->id)
            ->get();
         } else {
            $query = Routines::select($selected_query)
            ->where([
               ['user_id','=',$user->id],
               ['title','LIKE','%'.$search_query.'%'],
            ])->get();
         }

         foreach ($query as $key => $value) {
            
            foreach($icons as $keyi => $valuei){
               if($value->icon_id == $valuei->id) $value->icon_title = $valuei->title;            
            }            

         }
         
         return response()->json($query,200);
      } catch(\Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }
   }

   public function store(Request $request){
      $request->validate([
         'title' => ['required','string','max:255','min:6'],
         'description' => ['required','string','max:255','min:6'],
         'icon' => ['required'],
         'periodObj' => ['required'],
         'type' => ['required'],
         'color' => ['required'],
         'filterColor' => ['required'],
         'max' => ['required','min:1'],
      ]);

      try{

         $user = auth('api')->user();

         $icon = RoutinesIcons::where('title',$request->icon)->first();
         $type = RoutinesTypes::where('title', $request->type)->first();

         $new = Routines::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'icon_id' => $icon->id,
            'type_id' => $type->id,
            'max_val' => $request->max,
            'color' => $request->color,
            'filter_color' => $request->filterColor,
            'description' => $request->description,         
         ]);

         RoutinesPeriods::create([
            'routines_id'=>$new->id,
            'monday' => $request->periodObj['monday'],
            'tuesday' => $request->periodObj['tuesday'],
            'wednesday' => $request->periodObj['wednesday'],
            'thursday' => $request->periodObj['thursday'],
            'friday' => $request->periodObj['friday'],
            'saturday' => $request->periodObj['saturday'],
            'sunday' =>  $request->periodObj['sunday'],
         ]);
      
         return response()->json(['message'=>'Berhasil menambahkan data'],200);
      } catch(Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }

   }

   public function update(Request $request, $id){
      $request->validate([
         'title' => ['required','string','max:255','min:6'],
         'description' => ['required','string','max:255','min:6'],
         'icon' => ['required'],
         'periodObj' => ['required'],
         'type' => ['required'],
         'color' => ['required'],
         'filterColor' => ['required'],
         'max' => ['required','min:1'],
      ]);

      try{

         $user = auth('api')->user();
         $icon = RoutinesIcons::where('title',$request->icon)->first();
         $type = RoutinesTypes::where('title', $request->type)->first();

         $target = Routines::where('id',$id)->first();  
             
         if(is_null($target)) return response()->json(['message'=>'Data Not Found'],404);
         if($target->user_id !== auth('api')->user()->id) return response()->json(['errors'=>[$e],'message'=>'Tidak dapat mengubah milik orang lain'],403);

         $target->title = $request->title;
         $target->icon_id = $icon->id;
         $target->type_id = $type->id;
         $target->color = $request->color;
         $target->filter_color = $request->filterColor;
         $target->description = $request->description;

         if($target->max_val != $request->max){            
            RoutinesLogs::where([
               ['routines_id', '=', $target->id], 
               ['val', '=', $target->max_val], 
            ])->update(['val'=>$request->max]);

            $target->max_val = $request->max;
         }

         $target->save();

         $selected_field = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',  
         ];
         $period = RoutinesPeriods::select($selected_field)->where('routines_id',$target->id)->first();

         if(is_null($period)){
            RoutinesPeriods::create([
               'routines_id'=>$new->id,
               'monday' => $request->periodObj['monday'],
               'tuesday' => $request->periodObj['tuesday'],
               'wednesday' => $request->periodObj['wednesday'],
               'thursday' => $request->periodObj['thursday'],
               'friday' => $request->periodObj['friday'],
               'saturday' => $request->periodObj['saturday'],
               'sunday' =>  $request->periodObj['sunday'],
            ]);
         } else {
            $period->monday = $request->periodObj['monday'];
            $period->tuesday = $request->periodObj['tuesday'];
            $period->wednesday = $request->periodObj['wednesday'];
            $period->thursday = $request->periodObj['thursday'];
            $period->friday = $request->periodObj['friday'];
            $period->saturday = $request->periodObj['saturday'];
            $period->sunday =  $request->periodObj['sunday'];
            $period->save();
         }
      
         return response()->json(['message'=>'Berhasil mengubah data'],200);
      } catch(Exception $e) {
         return response()->json(['errors'=>[$e],'message'=>'Terjadi kesalahan dalam server'],500);
      }

   }

}