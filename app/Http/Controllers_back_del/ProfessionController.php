<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Professions;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ProfessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



public function index()
    {
        return view('professions');
    }

public function downloadExcel($type)
    {
        $data = Professions::get()->toArray();
        return Excel::create('professions', function($excel) use ($data) {
            $excel->sheet('professions', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }


public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] =
                [

                    'id' => $value->id, 
                    'id_professionals' => $value->id_professionals, 
                    'title' => $value->title,


                    'id_cat_1' => $value->id_cat_1,
                    'factor_cat_1' => $value->factor_cat_1, 
                    'value_from_cat_1' => $value->value_from_cat_1, 
                    'value_before_cat_1' => $value->value_before_cat_1,
                    
                    'id_cat_2' => $value->id_cat_2,
                    'factor_cat_2' => $value->factor_cat_2, 
                    'value_from_cat_2' => $value->value_from_cat_2, 
                    'value_before_cat_2' => $value->value_before_cat_2,

                    'id_cat_3' => $value->id_cat_3,
                    'factor_cat_3' => $value->factor_cat_3, 
                    'value_from_cat_3' => $value->value_from_cat_3, 
                    'value_before_cat_3' => $value->value_before_cat_3,

                    'id_cat_4' => $value->id_cat_4,
                    'factor_cat_4' => $value->factor_cat_4, 
                    'value_from_cat_4' => $value->value_from_cat_4, 
                    'value_before_cat_4' => $value->value_before_cat_4,

                    'id_cat_5' => $value->id_cat_5,
                    'factor_cat_5' => $value->factor_cat_5, 
                    'value_from_cat_5' => $value->value_from_cat_5, 
                    'value_before_cat_5' => $value->value_before_cat_5,

                    'id_cat_6' => $value->id_cat_6,
                    'factor_cat_6' => $value->factor_cat_6, 
                    'value_from_cat_6' => $value->value_from_cat_6, 
                    'value_before_cat_6' => $value->value_before_cat_6,

                    'id_cat_7' => $value->id_cat_7,
                    'factor_cat_7' => $value->factor_cat_7, 
                    'value_from_cat_7' => $value->value_from_cat_7, 
                    'value_before_cat_7' => $value->value_before_cat_7,

                    'id_cat_8' => $value->id_cat_8,
                    'factor_cat_8' => $value->factor_cat_8, 
                    'value_from_cat_8' => $value->value_from_cat_8, 
                    'value_before_cat_8' => $value->value_before_cat_8,

                    'id_cat_9' => $value->id_cat_9,
                    'factor_cat_9' => $value->factor_cat_9, 
                    'value_from_cat_9' => $value->value_from_cat_9, 
                    'value_before_cat_9' => $value->value_before_cat_9,

                    'id_cat_10' => $value->id_cat_10,
                    'factor_cat_10' => $value->factor_cat_10, 
                    'value_from_cat_10' => $value->value_from_cat_10, 
                    'value_before_cat_10' => $value->value_before_cat_10,

                    'id_cat_11' => $value->id_cat_11,
                    'factor_cat_11' => $value->factor_cat_11, 
                    'value_from_cat_11' => $value->value_from_cat_11, 
                    'value_before_cat_11' => $value->value_before_cat_11,

                    'id_cat_12' => $value->id_cat_12,
                    'factor_cat_12' => $value->factor_cat_12, 
                    'value_from_cat_12' => $value->value_from_cat_12, 
                    'value_before_cat_12' => $value->value_before_cat_12,

                    'id_cat_13' => $value->id_cat_13,
                    'factor_cat_13' => $value->factor_cat_13, 
                    'value_from_cat_13' => $value->value_from_cat_13, 
                    'value_before_cat_13' => $value->value_before_cat_13,

                    'id_cat_14' => $value->id_cat_14,
                    'factor_cat_14' => $value->factor_cat_14, 
                    'value_from_cat_14' => $value->value_from_cat_14, 
                    'value_before_cat_14' => $value->value_before_cat_14,

                    'id_cat_15' => $value->id_cat_15,
                    'factor_cat_15' => $value->factor_cat_15, 
                    'value_from_cat_15' => $value->value_from_cat_15, 
                    'value_before_cat_15' => $value->value_before_cat_15,

                    'id_cat_16' => $value->id_cat_16,
                    'factor_cat_16' => $value->factor_cat_16, 
                    'value_from_cat_16' => $value->value_from_cat_16, 
                    'value_before_cat_16' => $value->value_before_cat_16,

                    'id_cat_17' => $value->id_cat_17,
                    'factor_cat_17' => $value->factor_cat_17, 
                    'value_from_cat_17' => $value->value_from_cat_17, 
                    'value_before_cat_17' => $value->value_before_cat_17,

                    'id_cat_18' => $value->id_cat_18,
                    'factor_cat_18' => $value->factor_cat_18, 
                    'value_from_cat_18' => $value->value_from_cat_18, 
                    'value_before_cat_18' => $value->value_before_cat_18,
                    
                    'id_cat_19' => $value->id_cat_19,
                    'factor_cat_19' => $value->factor_cat_19, 
                    'value_from_cat_19' => $value->value_from_cat_19, 
                    'value_before_cat_19' => $value->value_before_cat_19,
                    
                    'id_cat_20' => $value->id_cat_20,
                    'factor_cat_20' => $value->factor_cat_20, 
                    'value_from_cat_20' => $value->value_from_cat_20, 
                    'value_before_cat_20' => $value->value_before_cat_20,
                     
                    'id_cat_21' => $value->id_cat_21,
                    'factor_cat_21' => $value->factor_cat_21, 
                    'value_from_cat_21' => $value->value_from_cat_21, 
                    'value_before_cat_21' => $value->value_before_cat_21,

                    'id_cat_22' => $value->id_cat_22,
                    'factor_cat_22' => $value->factor_cat_22, 
                    'value_from_cat_22' => $value->value_from_cat_22, 
                    'value_before_cat_22' => $value->value_before_cat_22,

                    'id_cat_23' => $value->id_cat_23,
                    'factor_cat_23' => $value->factor_cat_23, 
                    'value_from_cat_23' => $value->value_from_cat_23, 
                    'value_before_cat_23' => $value->value_before_cat_23,

                    'id_cat_24' => $value->id_cat_24,
                    'factor_cat_24' => $value->factor_cat_24, 
                    'value_from_cat_24' => $value->value_from_cat_24, 
                    'value_before_cat_24' => $value->value_before_cat_24,

                    'id_cat_25' => $value->id_cat_25,
                    'factor_cat_25' => $value->factor_cat_25, 
                    'value_from_cat_25' => $value->value_from_cat_25, 
                    'value_before_cat_25' => $value->value_before_cat_25,

                    'id_cat_26' => $value->id_cat_26,
                    'factor_cat_26' => $value->factor_cat_26, 
                    'value_from_cat_26' => $value->value_from_cat_26, 
                    'value_before_cat_26' => $value->value_before_cat_26,

                    'id_cat_27' => $value->id_cat_27,
                    'factor_cat_27' => $value->factor_cat_27, 
                    'value_from_cat_27' => $value->value_from_cat_27, 
                    'value_before_cat_27' => $value->value_before_cat_27,

                    'id_cat_28' => $value->id_cat_28,
                    'factor_cat_28' => $value->factor_cat_28, 
                    'value_from_cat_28' => $value->value_from_cat_28, 
                    'value_before_cat_28' => $value->value_before_cat_28,

                    'id_cat_29' => $value->id_cat_29,
                    'factor_cat_29' => $value->factor_cat_29, 
                    'value_from_cat_29' => $value->value_from_cat_29, 
                    'value_before_cat_29' => $value->value_before_cat_29,

                    'id_cat_30' => $value->id_cat_30,
                    'factor_cat_30' => $value->factor_cat_30, 
                    'value_from_cat_30' => $value->value_from_cat_30, 
                    'value_before_cat_30' => $value->value_before_cat_30,

                    'id_cat_31' => $value->id_cat_31,
                    'factor_cat_31' => $value->factor_cat_31, 
                    'value_from_cat_31' => $value->value_from_cat_31, 
                    'value_before_cat_31' => $value->value_before_cat_31,


                    'id_cat_32' => $value->id_cat_32,
                    'factor_cat_32' => $value->factor_cat_32, 
                    'value_from_cat_32' => $value->value_from_cat_32, 
                    'value_before_cat_32' => $value->value_before_cat_32,


                    'id_cat_33' => $value->id_cat_33,
                    'factor_cat_33' => $value->factor_cat_33, 
                    'value_from_cat_33' => $value->value_from_cat_33, 
                    'value_before_cat_33' => $value->value_before_cat_33,



                    'id_cat_34' => $value->id_cat_34,
                    'factor_cat_34' => $value->factor_cat_34, 
                    'value_from_cat_34' => $value->value_from_cat_34, 
                    'value_before_cat_34' => $value->value_before_cat_34,

                    'gender' => $value->gender, 
                    'level' => $value->level, 
                    'total' => $value->total,
                    'total_factor_yes' => $value->total_factor_yes,
                    'total_factor_yes_before' => $value->total_factor_yes_before,
                    'total_factor_yes_from' => $value->total_factor_yes_from,
                    'total_factor_no' => $value->total_factor_no,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at

                ];
                }
                if(!empty($insert)){
                    DB::table('professionals')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }


public function upup()
    {
        
        $professions = Professions::all();
        foreach ($professions as $profession) {
            
            if ($profession->value_from_cat_1 != 0 || $profession->value_before_cat_1 != 0) {
               
                if ($profession->factor_cat_1 == "н" || $profession->factor_cat_1 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_1 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_1 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_1 != 0 && $profession->value_before_cat_1 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_1 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_1 . " - " . $profession->value_from_cat_1 . " - " . $profession->value_before_cat_1 . "<br>";
            }
            

            if ($profession->value_from_cat_2 != 0 || $profession->value_before_cat_2 != 0) {
               
                if ($profession->factor_cat_2 == "н" || $profession->factor_cat_2 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_2 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_2 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_2 != 0 && $profession->value_before_cat_2 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_2 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_2 . " - " . $profession->value_from_cat_2 . " - " . $profession->value_before_cat_2 . "<br>";
            }

            if ($profession->value_from_cat_3 != 0 || $profession->value_before_cat_3 != 0) {
               
                if ($profession->factor_cat_3 == "н" || $profession->factor_cat_3 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_3 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_3 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_3 != 0 && $profession->value_before_cat_3 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_3 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_3 . " - " . $profession->value_from_cat_3 . " - " . $profession->value_before_cat_3 . "<br>";
            }

            if ($profession->value_from_cat_4 != 0 || $profession->value_before_cat_4 != 0) {
               
                if ($profession->factor_cat_4 == "н" || $profession->factor_cat_4 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_4 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_4 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_4 != 0 && $profession->value_before_cat_4 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_4 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_4 . " - " . $profession->value_from_cat_4 . " - " . $profession->value_before_cat_4 . "<br>";
            }

            if ($profession->value_from_cat_5 != 0 || $profession->value_before_cat_5 != 0) {
               
                if ($profession->factor_cat_5 == "н" || $profession->factor_cat_5 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_5 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_5 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_5 != 0 && $profession->value_before_cat_5 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_5 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_5 . " - " . $profession->value_from_cat_5 . " - " . $profession->value_before_cat_5 . "<br>";
            }

            if ($profession->value_from_cat_6 != 0 || $profession->value_before_cat_6 != 0) {
               
                if ($profession->factor_cat_6 == "н" || $profession->factor_cat_6 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_6 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_6 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_6 != 0 && $profession->value_before_cat_6 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_6 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_6 . " - " . $profession->value_from_cat_6 . " - " . $profession->value_before_cat_6 . "<br>";
            }

            if ($profession->value_from_cat_7 != 0 || $profession->value_before_cat_7 != 0) {
               
                if ($profession->factor_cat_7 == "н" || $profession->factor_cat_7 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_7 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_7 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_7 != 0 && $profession->value_before_cat_7 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_7 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_7 . " - " . $profession->value_from_cat_7 . " - " . $profession->value_before_cat_7 . "<br>";
            }

            if ($profession->value_from_cat_8 != 0 || $profession->value_before_cat_8 != 0) {
               
                if ($profession->factor_cat_8 == "н" || $profession->factor_cat_8 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_8 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_8 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_8 != 0 && $profession->value_before_cat_8 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_8 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_8 . " - " . $profession->value_from_cat_8 . " - " . $profession->value_before_cat_8 . "<br>";
            }

            if ($profession->value_from_cat_9 != 0 || $profession->value_before_cat_9 != 0) {
               
                if ($profession->factor_cat_9 == "н" || $profession->factor_cat_9 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_9 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_9 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_9 != 0 && $profession->value_before_cat_9 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_9 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_9 . " - " . $profession->value_from_cat_9 . " - " . $profession->value_before_cat_9 . "<br>";
            }

            if ($profession->value_from_cat_10 != 0 || $profession->value_before_cat_10 != 0) {
               
                if ($profession->factor_cat_10 == "н" || $profession->factor_cat_10 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_10 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_10 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_10 != 0 && $profession->value_before_cat_10 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_10 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_10 . " - " . $profession->value_from_cat_10 . " - " . $profession->value_before_cat_10 . "<br>";
            }

            if ($profession->value_from_cat_11 != 0 || $profession->value_before_cat_11 != 0) {
               
                if ($profession->factor_cat_11 == "н" || $profession->factor_cat_11 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_11 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_11 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_11 != 0 && $profession->value_before_cat_11 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_11 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_11 . " - " . $profession->value_from_cat_11 . " - " . $profession->value_before_cat_11 . "<br>";
            }

            if ($profession->value_from_cat_12 != 0 || $profession->value_before_cat_12 != 0) {
               
                if ($profession->factor_cat_12 == "н" || $profession->factor_cat_12 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_12 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_12 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_12 != 0 && $profession->value_before_cat_12 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_12 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_12 . " - " . $profession->value_from_cat_12 . " - " . $profession->value_before_cat_12 . "<br>";
            }

            if ($profession->value_from_cat_13 != 0 || $profession->value_before_cat_13 != 0) {
               
                if ($profession->factor_cat_13 == "н" || $profession->factor_cat_13 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_13 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_13 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_13 != 0 && $profession->value_before_cat_13 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_13 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_13 . " - " . $profession->value_from_cat_13 . " - " . $profession->value_before_cat_13 . "<br>";
            }

            if ($profession->value_from_cat_14 != 0 || $profession->value_before_cat_14 != 0) {
               
                if ($profession->factor_cat_14 == "н" || $profession->factor_cat_14 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_14 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_14 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_14 != 0 && $profession->value_before_cat_14 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_14 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_14 . " - " . $profession->value_from_cat_14 . " - " . $profession->value_before_cat_14 . "<br>";
            }

            if ($profession->value_from_cat_15 != 0 || $profession->value_before_cat_15 != 0) {
               
                if ($profession->factor_cat_15 == "н" || $profession->factor_cat_15 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_15 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_15 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_15 != 0 && $profession->value_before_cat_15 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_15 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_15 . " - " . $profession->value_from_cat_15 . " - " . $profession->value_before_cat_15 . "<br>";
            }
            if ($profession->value_from_cat_16 != 0 || $profession->value_before_cat_16 != 0) {
               
                if ($profession->factor_cat_16 == "н" || $profession->factor_cat_16 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_16 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_16 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_16 != 0 && $profession->value_before_cat_16 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_16 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_16 . " - " . $profession->value_from_cat_16 . " - " . $profession->value_before_cat_16 . "<br>";
            }

            if ($profession->value_from_cat_17 != 0 || $profession->value_before_cat_17 != 0) {
               
                if ($profession->factor_cat_17 == "н" || $profession->factor_cat_17 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_17 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_17 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_17 != 0 && $profession->value_before_cat_17 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_17 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_17 . " - " . $profession->value_from_cat_17 . " - " . $profession->value_before_cat_17 . "<br>";
            }

            if ($profession->value_from_cat_18 != 0 || $profession->value_before_cat_18 != 0) {
               
                if ($profession->factor_cat_18 == "н" || $profession->factor_cat_18 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_18 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_18 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_18 != 0 && $profession->value_before_cat_18 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_18 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_18 . " - " . $profession->value_from_cat_18 . " - " . $profession->value_before_cat_18 . "<br>";
            }

            if ($profession->value_from_cat_19 != 0 || $profession->value_before_cat_19 != 0) {
               
                if ($profession->factor_cat_19 == "н" || $profession->factor_cat_19 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_19 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_19 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_19 != 0 && $profession->value_before_cat_19 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_19 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_19 . " - " . $profession->value_from_cat_19 . " - " . $profession->value_before_cat_19 . "<br>";
            }

            if ($profession->value_from_cat_20 != 0 || $profession->value_before_cat_20 != 0) {
               
                if ($profession->factor_cat_20 == "н" || $profession->factor_cat_20 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_20 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_20 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_20 != 0 && $profession->value_before_cat_20 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_20 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_20 . " - " . $profession->value_from_cat_20 . " - " . $profession->value_before_cat_20 . "<br>";
            }

            if ($profession->value_from_cat_21 != 0 || $profession->value_before_cat_21 != 0) {
               
                if ($profession->factor_cat_21 == "н" || $profession->factor_cat_21 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_21 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_21 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_21 != 0 && $profession->value_before_cat_21 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_21 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_21 . " - " . $profession->value_from_cat_21 . " - " . $profession->value_before_cat_21 . "<br>";
            }

            if ($profession->value_from_cat_22 != 0 || $profession->value_before_cat_22 != 0) {
               
                if ($profession->factor_cat_22 == "н" || $profession->factor_cat_22 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_22 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_22 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_22 != 0 && $profession->value_before_cat_22 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_22 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_22 . " - " . $profession->value_from_cat_22 . " - " . $profession->value_before_cat_22 . "<br>";
            }

             if ($profession->value_from_cat_23 != 0 || $profession->value_before_cat_23 != 0) {
               
                if ($profession->factor_cat_23 == "н" || $profession->factor_cat_23 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_23 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_23 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_23 != 0 && $profession->value_before_cat_23 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_23 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_23 . " - " . $profession->value_from_cat_23 . " - " . $profession->value_before_cat_23 . "<br>";
            }

             if ($profession->value_from_cat_24 != 0 || $profession->value_before_cat_24 != 0) {
               
                if ($profession->factor_cat_24 == "н" || $profession->factor_cat_24 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_24 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_24 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_24 != 0 && $profession->value_before_cat_24 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_24 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_24 . " - " . $profession->value_from_cat_24 . " - " . $profession->value_before_cat_24 . "<br>";
            }

             if ($profession->value_from_cat_25 != 0 || $profession->value_before_cat_25 != 0) {
               
                if ($profession->factor_cat_25 == "н" || $profession->factor_cat_25 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_25 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_25 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_25 != 0 && $profession->value_before_cat_25 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_25 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_25 . " - " . $profession->value_from_cat_25 . " - " . $profession->value_before_cat_25 . "<br>";
            }

             if ($profession->value_from_cat_26 != 0 || $profession->value_before_cat_26 != 0) {
               
                if ($profession->factor_cat_26 == "н" || $profession->factor_cat_26 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_26 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_26 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_26 != 0 && $profession->value_before_cat_26 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_26 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_26 . " - " . $profession->value_from_cat_26 . " - " . $profession->value_before_cat_26 . "<br>";
            }

             if ($profession->value_from_cat_27 != 0 || $profession->value_before_cat_27 != 0) {
               
                if ($profession->factor_cat_27 == "н" || $profession->factor_cat_27 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_27 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_27 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_27 != 0 && $profession->value_before_cat_27 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_27 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_27 . " - " . $profession->value_from_cat_27 . " - " . $profession->value_before_cat_27 . "<br>";
            }

             if ($profession->value_from_cat_28 != 0 || $profession->value_before_cat_28 != 0) {
               
                if ($profession->factor_cat_28 == "н" || $profession->factor_cat_28 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_28 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_28 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_28 != 0 && $profession->value_before_cat_28 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_28 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_28 . " - " . $profession->value_from_cat_28 . " - " . $profession->value_before_cat_28 . "<br>";
            }

             if ($profession->value_from_cat_29 != 0 || $profession->value_before_cat_29 != 0) {
               
                if ($profession->factor_cat_29 == "н" || $profession->factor_cat_29 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_29 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_29 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_29 != 0 && $profession->value_before_cat_29 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_29 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_29 . " - " . $profession->value_from_cat_29 . " - " . $profession->value_before_cat_29 . "<br>";
            }

             if ($profession->value_from_cat_30 != 0 || $profession->value_before_cat_30 != 0) {
               
                if ($profession->factor_cat_30 == "н" || $profession->factor_cat_30 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_30 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_30 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_30 != 0 && $profession->value_before_cat_30 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_30 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_30 . " - " . $profession->value_from_cat_30 . " - " . $profession->value_before_cat_30 . "<br>";
            }

             if ($profession->value_from_cat_31 != 0 || $profession->value_before_cat_31 != 0) {
               
                if ($profession->factor_cat_31 == "н" || $profession->factor_cat_31 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_31 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_31 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_31 != 0 && $profession->value_before_cat_31 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_31 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_31 . " - " . $profession->value_from_cat_31 . " - " . $profession->value_before_cat_31 . "<br>";
            }

             if ($profession->value_from_cat_32 != 0 || $profession->value_before_cat_32 != 0) {
               
                if ($profession->factor_cat_32 == "н" || $profession->factor_cat_32 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_32 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_32 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_32 != 0 && $profession->value_before_cat_32 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_32 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_32 . " - " . $profession->value_from_cat_32 . " - " . $profession->value_before_cat_32 . "<br>";
            }

             if ($profession->value_from_cat_33 != 0 || $profession->value_before_cat_33 != 0) {
               
                if ($profession->factor_cat_33 == "н" || $profession->factor_cat_33 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_33 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_33 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_33 != 0 && $profession->value_before_cat_33 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_33 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_33 . " - " . $profession->value_from_cat_33 . " - " . $profession->value_before_cat_33 . "<br>";
            }

             if ($profession->value_from_cat_34 != 0 || $profession->value_before_cat_34 != 0) {
               
                if ($profession->factor_cat_34 == "н" || $profession->factor_cat_34 == "no") {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_34 = "no";
                $prof->save();
                }
                else
                {
                $prof = Professions::find($profession->id);
                $prof->factor_cat_34 = "yes";
                $prof->save();
                }

                if ($profession->value_from_cat_34 != 0 && $profession->value_before_cat_34 == 0) {
                   
                $prof = Professions::find($profession->id);
                $prof->value_before_cat_34 = 1000;
                $prof->save();
                }
                 echo $profession->title . " - " . $profession->factor_cat_34 . " - " . $profession->value_from_cat_34 . " - " . $profession->value_before_cat_34 . "<br>";
            }




        }
        dd("upup");
    }



}
