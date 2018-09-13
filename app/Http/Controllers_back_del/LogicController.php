<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issues;
use App\DiaryTests;
use Illuminate\Support\Facades\Auth;
use App\Categories;
use App\User;
use App\Result;
use App\Professions;
use App\Coinprofessions;
use App\UsersProfessions;

use App\prof_all_conditions;
use App\prof_no_1_conditions;
use App\prof_no_2_conditions;
use App\prof_no_3_conditions;
use App\prof_no_4_conditions;
use App\prof_no_5_conditions;
use App\prof_no_6_conditions;



use Illuminate\Support\Facades\DB;

class LogicController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function algoritm(Request $request)
                        {
                           // DB::table('coinprofessions')->truncate(); 
                            $user_id = Auth::id();
                            $table = DB::table('coinprofessions')->where('user_id', '=', $user_id)->delete();
                            $user_prof_del = DB::table('user_profession')->where('user_id', '=', $user_id)->delete();
                            $professions = Professions::all();
                            foreach ($professions as $profession) 
                            {

                                $total_executed = 0; // общее количество выполенных
                                $total_unfulfilled = 0; // общее количество не выполненных

                                $total_executed_factor_yes = 0;
                                $total_executed_factor_no = 0;

                                $total_unfulfilled_factor_yes = 0;
                                $total_unfulfilled_factor_no = 0;

                                $total_executed_factor_yes_before = 0;
                                $total_unfulfilled_factor_yes_before = 0;

                                $total_executed_factor_yes_from = 0;
                                $total_unfulfilled_factor_yes_from = 0;

                                $array_unfulfilled = array();



                                if ($profession->factor_cat_1 == "yes" or $profession->factor_cat_1 == "no") 
                                	{
                                    
	                                    if (($profession->value_from_cat_1 <= $request->theme1) && ($request->theme1 < $profession->value_before_cat_1)) 
	                                        {
	                                        
													$coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_1; 
                                                $coinprofession->save(); 

													$total_executed = $total_executed + 1;

				                                    if ($profession->factor_cat_1 == "yes") 
					                                    {
					                                        $total_executed_factor_yes = $total_executed_factor_yes + 1;
					                                    }

				                                    if ($profession->factor_cat_1 == "no") 
					                                    { 
					                                        $total_executed_factor_no = $total_executed_factor_no + 1;
					                                    }

			                                        if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 == 0)) 
			                                            {
			                                            	$total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
			                                            }
	                                                
	                                    	}

	                                    else
	                                    
	                                    	{

	                                        		$total_unfulfilled = $total_unfulfilled +1; 

			                                        if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 == 0)) 
				                                        {
				                                        	$total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
				                                        }


if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 != 0)) 
														{
					                                        $array_unfulfille_1 = array('1');
					                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_1);
	                                        			}
	                                        

	                                            	if ($profession->factor_cat_1 == "yes") 
	                                            		{
	                                            			$total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
	                                            		}

		                                            if ($profession->factor_cat_1 == "no") 
			                                            {
			                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
			                                            }
	                                    	} 
                                	}

                               
///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_2 == "yes" or $profession->factor_cat_2 == "no") 
                                	{
                                    
	                                    if (($profession->value_from_cat_2 <= $request->theme2) && ($request->theme2 < $profession->value_before_cat_2)) 
	                                        {
	                                        
													
	                                        	$coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_2; 
                                                $coinprofession->save(); 
													$total_executed = $total_executed + 1;

				                                    if ($profession->factor_cat_2 == "yes") 
					                                    {
					                                        $total_executed_factor_yes = $total_executed_factor_yes + 1;
					                                    }

				                                    if ($profession->factor_cat_2 == "no") 
					                                    { 
					                                        $total_executed_factor_no = $total_executed_factor_no + 1;
					                                    }

			                                        if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 == 0)) 
			                                            {
			                                            	$total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
			                                            }
	                                                
	                                    	}

	                                    else
	                                    
	                                    	{

	                                        		$total_unfulfilled = $total_unfulfilled +1; 

			                                        if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 == 0)) 
				                                        {
				                                        	$total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
				                                        }


if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 != 0)) 
														{
					                                        $array_unfulfille_2 = array('2');
					                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_2);
	                                        			}
	                                        

	                                            	if ($profession->factor_cat_2 == "yes") 
	                                            		{
	                                            			$total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
	                                            		}

		                                            if ($profession->factor_cat_2 == "no") 
			                                            {
			                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
			                                            }
	                                    	} 
                                	}

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_3 == "yes" or $profession->factor_cat_3 == "no") 
                                	{
                                    
	                                    if (($profession->value_from_cat_3 <= $request->theme3) && ($request->theme3 < $profession->value_before_cat_3)) 
	                                        {
	                                        
													$coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_3; 
                                                $coinprofession->save(); 
													$total_executed = $total_executed + 1;

				                                    if ($profession->factor_cat_3 == "yes") 
					                                    {
					                                        $total_executed_factor_yes = $total_executed_factor_yes + 1;
					                                    }

				                                    if ($profession->factor_cat_3 == "no") 
					                                    { 
					                                        $total_executed_factor_no = $total_executed_factor_no + 1;
					                                    }

			                                        if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 == 0)) 
			                                            {
			                                            	$total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
			                                            }
	                                                
	                                    	}

	                                    else
	                                    
	                                    	{

	                                        		$total_unfulfilled = $total_unfulfilled +1; 

			                                        if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 == 0)) 
				                                        {
				                                        	$total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
				                                        }


if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 != 0)) 
														{
					                                        $array_unfulfille_3 = array('3');
					                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_3);
	                                        			}
	                                        

	                                            	if ($profession->factor_cat_3 == "yes") 
	                                            		{
	                                            			$total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
	                                            		}

		                                            if ($profession->factor_cat_3 == "no") 
			                                            {
			                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
			                                            }
	                                    	} 
                                	}

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_4 == "yes" or $profession->factor_cat_4 == "no") 
                                	{
                                    
                                    	if (($profession->value_from_cat_4 <= $request->theme4) && ($request->theme4 < $profession->value_before_cat_4)) 
                                    		{
    										 	$coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_4; 
                                                $coinprofession->save(); 
    										 	$total_executed = $total_executed +1;
                                        
		                                        if ($profession->factor_cat_4 == "yes") 
		                                        {
		                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
		                                        }

		                                        if ($profession->factor_cat_4 == "no")
		                                        { 
		                                            $total_executed_factor_no = $total_executed_factor_no + 1;
		                                        }

		                                        if (($profession->factor_cat_4 == "yes") && ($profession->value_from_cat_4 == 0)) 
		                                        {
		                                        	$total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
		                                        }

                                    		}



                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_4 == "yes") && ($profession->value_from_cat_4 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_4 == "yes") && ($profession->value_from_cat_4 != 0)) {
                                        $array_unfulfille_4 = array('4');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_4);
                                        }
                                            if ($profession->factor_cat_4 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_4 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                    
                                }     

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_5 == "yes" or $profession->factor_cat_5 == "no") {
                                    
                                    if (($profession->value_from_cat_5 <= $request->theme5) && ($request->theme5 < $profession->value_before_cat_5)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_5; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_5 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_5 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    

	                                    if (($profession->factor_cat_5 == "yes") && ($profession->value_from_cat_5 == 0)) 
	                                        {
	                                        
	                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
	                                        }
                                    }
                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_5 == "yes") && ($profession->value_from_cat_5 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_5 == "yes") && ($profession->value_from_cat_5 != 0)) {
                                        $array_unfulfille_5 = array('5');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_5);
                                        }
                                            if ($profession->factor_cat_5 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_5 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                        
                                }

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_6 == "yes" or $profession->factor_cat_6 == "9") {
                                    
                                    if (($profession->value_from_cat_6 <= $request->theme6) && ($request->theme6 < $profession->value_before_cat_6)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_6; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_6 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_6 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    

                                    if (($profession->factor_cat_6 == "yes") && ($profession->value_from_cat_6 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_6 == "yes") && ($profession->value_from_cat_6 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_6 == "yes") && ($profession->value_from_cat_6 != 0)) {
                                        $array_unfulfille_6 = array('6');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_6);
                                        }
                                            if ($profession->factor_cat_6 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_6 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                        
                                }

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_7 == "yes" or $profession->factor_cat_7 == "no") {
                                    
                                    if (($profession->value_from_cat_7 <= $request->theme7) && ($request->theme7 < $profession->value_before_cat_7)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_7; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        


                                        if ($profession->factor_cat_7 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_7 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_7 == "yes") && ($profession->value_from_cat_7 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_7 == "yes") && ($profession->value_from_cat_7 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_7 == "yes") && ($profession->value_from_cat_7 != 0)) {
                                        $array_unfulfille_7 = array('7');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_7);
                                        }

                                            if ($profession->factor_cat_7 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_7 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }

                                    }

                                }

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_8 == "yes" or $profession->factor_cat_8 == "no") {
                                    
                                    if (($profession->value_from_cat_8 <= $request->theme8) && ($request->theme8 < $profession->value_before_cat_8)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_8; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_8 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_8 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_8 == "yes") && ($profession->value_from_cat_8 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_8 == "yes") && ($profession->value_from_cat_8 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_8 == "yes") && ($profession->value_from_cat_8 != 0)) {
                                        $array_unfulfille_8 = array('8');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_8);
                                        }
                                            if ($profession->factor_cat_8 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_8 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                        
                                }

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_9 == "yes" or $profession->factor_cat_9 == "no") {
                                    
                                    if (($profession->value_from_cat_9 <= $request->theme9) && ($request->theme9 < $profession->value_before_cat_9)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_9; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_9 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_9 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_9 == "yes") && ($profession->value_from_cat_9 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_9 == "yes") && ($profession->value_from_cat_9 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_9 == "yes") && ($profession->value_from_cat_9 != 0)) {
                                        $array_unfulfille_9 = array('9');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_9);
                                        }

                                            if ($profession->factor_cat_9 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_9 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_10 == "yes" or $profession->factor_cat_10 == "no") {
                                    
                                    if (($profession->value_from_cat_10 <= $request->theme10) && ($request->theme10 < $profession->value_before_cat_10)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_10; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_10 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_10 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_10 == "yes") && ($profession->value_from_cat_10 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

									}
                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1;

                                         if (($profession->factor_cat_10 == "yes") && ($profession->value_from_cat_10 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_10 == "yes") && ($profession->value_from_cat_10 != 0)) {
                                        $array_unfulfille_10 = array('10');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_10);
                                        }
                                            if ($profession->factor_cat_10 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_10 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_11 == "yes" or $profession->factor_cat_11 == "no") {
                                    
                                    if (($profession->value_from_cat_11 <= $request->theme11) && ($request->theme11 < $profession->value_before_cat_11)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_11; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_11 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_11 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    


                                    if (($profession->factor_cat_11 == "yes") && ($profession->value_from_cat_11 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }
                                        }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_11 == "yes") && ($profession->value_from_cat_11 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_11 == "yes") && ($profession->value_from_cat_11 != 0)) {
                                        $array_unfulfille_11 = array('11');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_11);
                                        }


                                            if ($profession->factor_cat_11 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_11 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                    
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_12 == "yes" or $profession->factor_cat_12 == "no") {
                                    
                                    if (($profession->value_from_cat_12 <= $request->theme12) && ($request->theme12 < $profession->value_before_cat_12)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_12; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_12 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_12 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    


                                    	if (($profession->factor_cat_12 == "yes") && ($profession->value_from_cat_12 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_12 == "yes") && ($profession->value_from_cat_12 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_12 == "yes") && ($profession->value_from_cat_12 != 0)) {
                                        $array_unfulfille_12 = array('12');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_12);
                                        }

                                            if ($profession->factor_cat_12 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_12 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_13 == "yes" or $profession->factor_cat_13 == "no") {
                                    
                                    if (($profession->value_from_cat_13 <= $request->theme13) && ($request->theme13 < $profession->value_before_cat_13)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_13; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_13 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_13 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    
                                    


                                    if (($profession->factor_cat_13 == "yes") && ($profession->value_from_cat_13 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_13 == "yes") && ($profession->value_from_cat_13 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_13 == "yes") && ($profession->value_from_cat_13 != 0)) {
                                        $array_unfulfille_13 = array('13');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_13);
                                        }

                                            if ($profession->factor_cat_13 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_13 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_14 == "yes" or $profession->factor_cat_14 == "no") {
                                    
                                    if (($profession->value_from_cat_14 <= $request->theme14) && ($request->theme14 < $profession->value_before_cat_14)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_14; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_14 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_14 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    


                                    if (($profession->factor_cat_14 == "yes") && ($profession->value_from_cat_14 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_14 == "yes") && ($profession->value_from_cat_14 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_14 == "yes") && ($profession->value_from_cat_14 != 0)) {
                                        $array_unfulfille_14 = array('14');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_14);
                                        }

                                            if ($profession->factor_cat_14 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_14 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                        
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_15 == "yes" or $profession->factor_cat_15 == "no") {
                                    
                                    if (($profession->value_from_cat_15 <= $request->theme15) && ($request->theme15 < $profession->value_before_cat_15)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_15; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_15 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_15 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    

                                    if (($profession->factor_cat_15 == "yes") && ($profession->value_from_cat_15 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_15 == "yes") && ($profession->value_from_cat_15 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_15 == "yes") && ($profession->value_from_cat_15 != 0)) {
                                        $array_unfulfille_15 = array('15');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_15);
                                        }

                                            if ($profession->factor_cat_15 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_15 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                     
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_16 == "yes" or $profession->factor_cat_16 == "no") {
                                    
                                    if (($profession->value_from_cat_16 <= $request->theme16) && ($request->theme16 < $profession->value_before_cat_16)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_16; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_16 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_16 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }   

                                    

                                    if (($profession->factor_cat_16 == "yes") && ($profession->value_from_cat_16 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1;

                                         if (($profession->factor_cat_16 == "yes") && ($profession->value_from_cat_16 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_16 == "yes") && ($profession->value_from_cat_16 != 0)) {
                                        $array_unfulfille_16 = array('16');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_16);
                                        }

                                            if ($profession->factor_cat_16 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_16 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_17 == "yes" or $profession->factor_cat_17 == "no") {
                                    
                                    if (($profession->value_from_cat_17 <= $request->theme17) && ($request->theme17 < $profession->value_before_cat_17)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_17; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_17 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_17 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_17 == "yes") && ($profession->value_from_cat_17 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_17 == "yes") && ($profession->value_from_cat_17 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_17 == "yes") && ($profession->value_from_cat_17 != 0)) {
                                        $array_unfulfille_17 = array('17');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_17);
                                        }

                                            if ($profession->factor_cat_17 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_17 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_18 == "yes" or $profession->factor_cat_18 == "no") {
                                    
                                    if (($profession->value_from_cat_18 <= $request->theme18) && ($request->theme18 < $profession->value_before_cat_18)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_18; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;


                                        if ($profession->factor_cat_18 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_18 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }
                                    

                                    if (($profession->factor_cat_18 == "yes") && ($profession->value_from_cat_18 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_18 == "yes") && ($profession->value_from_cat_18 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_18 == "yes") && ($profession->value_from_cat_18 != 0)) {
                                        $array_unfulfille_18 = array('18');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_18);
                                        }

                                            if ($profession->factor_cat_18 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_18 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_19 == "yes" or $profession->factor_cat_19 == "no") {
                                    
                                    if (($profession->value_from_cat_19 <= $request->theme19) && ($request->theme19 < $profession->value_before_cat_19)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_19; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                       
                                        if ($profession->factor_cat_19 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_19 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }
                                    


                                    if (($profession->factor_cat_19 == "yes") && ($profession->value_from_cat_19 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_19 == "yes") && ($profession->value_from_cat_19 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_19 == "yes") && ($profession->value_from_cat_19 != 0)) {
                                        $array_unfulfille_19 = array('19');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_19);
                                    }
                                            if ($profession->factor_cat_19 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_19 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                      
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_20 == "yes" or $profession->factor_cat_20 == "no") {
                                    
                                    if (($profession->value_from_cat_20 <= $request->theme20) && ($request->theme20 < $profession->value_before_cat_20)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_20; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_20 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_20 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    

                                    if (($profession->factor_cat_20 == "yes") && ($profession->value_from_cat_20 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_20 == "yes") && ($profession->value_from_cat_20 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_20 == "yes") && ($profession->value_from_cat_20 != 0)) {
                                        $array_unfulfille_20 = array('20');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_20);
                                    }

                                            if ($profession->factor_cat_20 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_20 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                }

///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_21 == "yes" or $profession->factor_cat_21 == "no") {
                                    
                                    if (($profession->value_from_cat_21 <= $request->theme21) && ($request->theme21 < $profession->value_before_cat_21)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_21; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_21 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_21 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }
                                    


                                    if (($profession->factor_cat_21 == "yes") && ($profession->value_from_cat_21 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_21 == "yes") && ($profession->value_from_cat_21 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_21 == "yes") && ($profession->value_from_cat_21 != 0)) {
                                        $array_unfulfille_21 = array('21');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_21);
                                    }    
                                            if ($profession->factor_cat_21 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_21 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                       
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_22 == "yes" or $profession->factor_cat_22 == "no") {
                                    
                                    if (($profession->value_from_cat_22 <= $request->theme22) && ($request->theme22 < $profession->value_before_cat_22)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_22; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_22 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_22 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_22 == "yes") && ($profession->value_from_cat_22 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_22 == "yes") && ($profession->value_from_cat_22 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_22 == "yes") && ($profession->value_from_cat_22 != 0)) {
                                        $array_unfulfille_22 = array('22');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_22);
                                    }

                                            if ($profession->factor_cat_22 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_22 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_23 == "yes" or $profession->factor_cat_23 == "no") {
                                    
                                    if (($profession->value_from_cat_23 <= $request->theme23) && ($request->theme23 < $profession->value_before_cat_23)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_23; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_23 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_23 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_23 == "yes") && ($profession->value_from_cat_23 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }



                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_23 == "yes") && ($profession->value_from_cat_23 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_23 == "yes") && ($profession->value_from_cat_23 != 0)) {
                                        $array_unfulfille_23 = array('23');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_23);
                                    }
                                            if ($profession->factor_cat_23 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_23 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_24 == "yes" or $profession->factor_cat_24 == "no") {
                                    
                                    if (($profession->value_from_cat_24 <= $request->theme24) && ($request->theme24 < $profession->value_before_cat_24)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_24; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_24 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_24 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_24 == "yes") && ($profession->value_from_cat_24 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_24 == "yes") && ($profession->value_from_cat_24 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_24 == "yes") && ($profession->value_from_cat_24 != 0)) {
                                        $array_unfulfille_24 = array('24');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_24);
                                    }
                                            if ($profession->factor_cat_24 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_24 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                        
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_25 == "yes" or $profession->factor_cat_25 == "no") {
                                    
                                    if (($profession->value_from_cat_25 <= $request->theme25) && ($request->theme25 < $profession->value_before_cat_25)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_25; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_25 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_25 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_25 == "yes") && ($profession->value_from_cat_25 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_25 == "yes") && ($profession->value_from_cat_25 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_25 == "yes") && ($profession->value_from_cat_25 != 0)) {
                                        $array_unfulfille_25 = array('25');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_25);
                                    }
                                            if ($profession->factor_cat_25 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_25 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_26 == "yes" or $profession->factor_cat_26 == "no") {
                                    
                                    if (($profession->value_from_cat_26 <= $request->theme26) && ($request->theme26 < $profession->value_before_cat_26)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_26; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_26 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_26 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_26 == "yes") && ($profession->value_from_cat_26 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_26 == "yes") && ($profession->value_from_cat_26 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_26 == "yes") && ($profession->value_from_cat_26 != 0)) {
                                        $array_unfulfille_26 = array('26');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_26);
                                    }
                                            if ($profession->factor_cat_26 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_26 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_27 == "yes" or $profession->factor_cat_27 == "no") {
                                    
                                    if (($profession->value_from_cat_27 <= $request->theme27) && ($request->theme27 < $profession->value_before_cat_27)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_27; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_27 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_27 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    

                                    if (($profession->factor_cat_27 == "yes") && ($profession->value_from_cat_27 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1;

                                         if (($profession->factor_cat_27 == "yes") && ($profession->value_from_cat_27 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_27 == "yes") && ($profession->value_from_cat_27 != 0)) {
                                        $array_unfulfille_27 = array('27');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_27);
                                    }
                                            if ($profession->factor_cat_27 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_27 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_28 == "yes" or $profession->factor_cat_28 == "no") {
                                    
                                    if (($profession->value_from_cat_28 <= $request->theme28) && ($request->theme28 < $profession->value_before_cat_28)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_28; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_28 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_28 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }
                                    


                                    if (($profession->factor_cat_28 == "yes") && ($profession->value_from_cat_28 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_28 == "yes") && ($profession->value_from_cat_28 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_28 == "yes") && ($profession->value_from_cat_28 != 0)) {
                                        $array_unfulfille_28 = array('28');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_28);
                                    }


                                            if ($profession->factor_cat_28 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_28 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_29 == "yes" or $profession->factor_cat_29 == "no") {
                                    
                                    if (($profession->value_from_cat_29 <= $request->theme29) && ($request->theme29 < $profession->value_before_cat_29)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_29; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_29 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_29 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }
                                    


                                    if (($profession->factor_cat_29 == "yes") && ($profession->value_from_cat_29 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                         if (($profession->factor_cat_29 == "yes") && ($profession->value_from_cat_29 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }



if (($profession->factor_cat_29 == "yes") && ($profession->value_from_cat_29 != 0)) {
                                        $array_unfulfille_29 = array('29');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_29);
                                    }
                                            if ($profession->factor_cat_29 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_29 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_30 == "yes" or $profession->factor_cat_30 == "no") {
                                    
                                    if (($profession->value_from_cat_30 <= $request->theme30) && ($request->theme30 < $profession->value_before_cat_30)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_30; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_30 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_30 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    


                                    if (($profession->factor_cat_30 == "yes") && ($profession->value_from_cat_30 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                        if (($profession->factor_cat_30 == "yes") && ($profession->value_from_cat_30 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_30 == "yes") && ($profession->value_from_cat_30 != 0)) {
                                        $array_unfulfille_30 = array('30');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_30);
                                        }

                                            if ($profession->factor_cat_30 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_30 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_31 == "yes" or $profession->factor_cat_31 == "no") {
                                    
                                    if (($profession->value_from_cat_31 <= $request->theme31) && ($request->theme31 < $profession->value_before_cat_31)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_31; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_31 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_31 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_31 == "yes") && ($profession->value_from_cat_31 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                        if (($profession->factor_cat_31 == "yes") && ($profession->value_from_cat_31 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_31 == "yes") && ($profession->value_from_cat_31 != 0)) {
                                        $array_unfulfille_31 = array('31');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_31);
                                    }

                                            if ($profession->factor_cat_31 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_31 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_32 == "yes" or $profession->factor_cat_32 == "no") {
                                    
                                    if (($profession->value_from_cat_32 <= $request->theme32) && ($request->theme32 < $profession->value_before_cat_32)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_32; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_32 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_32 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_32 == "yes") && ($profession->value_from_cat_32 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                        if (($profession->factor_cat_32 == "yes") && ($profession->value_from_cat_32 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_32 == "yes") && ($profession->value_from_cat_32 != 0)) {
                                        $array_unfulfille_32 = array('32');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_32);
                                    }
                                            if ($profession->factor_cat_32 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_32 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }


///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_33 == "yes" or $profession->factor_cat_33 == "no") {
                                    
                                    if (($profession->value_from_cat_33 <= $request->theme33) && ($request->theme33 < $profession->value_before_cat_33)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_33; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_33 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_33 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_33 == "yes") && ($profession->value_from_cat_33 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                        if (($profession->factor_cat_33 == "yes") && ($profession->value_from_cat_33 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_33 == "yes") && ($profession->value_from_cat_33 != 0)) {
                                        $array_unfulfille_33 = array('33');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_33);
                                    }

                                            if ($profession->factor_cat_33 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_33 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }

                                
///-----------------------------------------------------------------------------------------------------------------------------------
                                if ($profession->factor_cat_34 == "yes" or $profession->factor_cat_34 == "no") {
                                    
                                    if (($profession->value_from_cat_34 <= $request->theme34) && ($request->theme34 < $profession->value_before_cat_34)) {
                                        
										$total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_34 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_34 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    


                                    if (($profession->factor_cat_34 == "yes") && ($profession->value_from_cat_34 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                    }


                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1; 

                                        if (($profession->factor_cat_34 == "yes") && ($profession->value_from_cat_34 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_34 == "yes") && ($profession->value_from_cat_34 != 0)) {
                                        $array_unfulfille_34 = array('34');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_34);
                                    }

                                            if ($profession->factor_cat_34 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_34 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }
                                }

                                $total = $total_unfulfilled + $total_executed;
                                $total_unfulfilled_factor_yes_from = count($array_unfulfilled);
                                $array_unfulfilled_json_from =  json_encode($array_unfulfilled);

$total_executed_factor_yes_from = $total_executed_factor_yes - $total_executed_factor_yes_before;

$total_unfulfilled_factor_yes_from = $total_unfulfilled_factor_yes - $total_unfulfilled_factor_yes_before;
                                
$rating = (0.7 * $total_executed_factor_yes_from + $total_executed_factor_yes_before)/($profession->total_factor_yes_from + $profession->total_factor_no);
//$rating = $rating * 10000;
//dump($rating);
 								$user_profession = new UsersProfessions;
                                $user_profession->user_id =  $user_id;
                                $user_profession->prof_id =  $profession->id;
                                $user_profession->prof_title =  $profession->title;

                                $user_profession->total_executed =  $total_executed;
                                $user_profession->total_unfulfilled =  $total_unfulfilled;

                                $user_profession->total_executed_factor_yes =  $total_executed_factor_yes;
                                $user_profession->total_executed_factor_no =  $total_executed_factor_no;

                                $user_profession->total_executed_factor_yes_before =  $total_executed_factor_yes_before;
                                $user_profession->total_executed_factor_yes_from =  $total_executed_factor_yes_from;

                                $user_profession->total_unfulfilled_factor_yes =  $total_unfulfilled_factor_yes;
                                $user_profession->total_unfulfilled_factor_no =  $total_unfulfilled_factor_no;

                                $user_profession->total_unfulfilled_factor_yes_before =  $total_unfulfilled_factor_yes_before;
                                $user_profession->total_unfulfilled_factor_yes_from =  $total_unfulfilled_factor_yes_from;

                                $user_profession->total =  $profession->total;
                                $user_profession->array_unfulfilled_json_from = $array_unfulfilled_json_from;

                                $user_profession->total_factor_yes =  $profession->total_factor_yes;
                                $user_profession->total_factor_yes_before =  $profession->total_factor_yes_before;
                                $user_profession->total_factor_yes_from = $profession->total_factor_yes_from;

                                $user_profession->total_factor_no =  $profession->total_factor_no;

                                $user_profession->rating =  $rating;

                                $user_profession->prof_gender =  $profession->gender;
                                $user_profession->prof_level =  $profession->level;

                                $user_profession->save();




                            }

                           // dd('Готово');
                             return redirect('table2');
                              
                        }


                        public function table2()
                        {
                            $user_id = Auth::id();
                            $user = User::find($user_id);
                            $user_gender = $user->gender;
                           // dd($user_gender);
$tableAll = DB::table('prof_all_conditions')->where('user_id', '=', $user_id)->delete();
$table1 = DB::table('prof_no_1_conditions')->where('user_id', '=', $user_id)->delete();
$table2 = DB::table('prof_no_2_conditions')->where('user_id', '=', $user_id)->delete();
$table3 = DB::table('prof_no_3_conditions')->where('user_id', '=', $user_id)->delete();
$table4 = DB::table('prof_no_4_conditions')->where('user_id', '=', $user_id)->delete();
$table5 = DB::table('prof_no_5_conditions')->where('user_id', '=', $user_id)->delete();
$table6 = DB::table('prof_no_6_conditions')->where('user_id', '=', $user_id)->delete();

$tables = DB::table('user_profession')->where('user_id', '=', $user_id)->orderBy('total_unfulfilled_factor_yes_from', 'asc' )->get();



$professions = DB::table('user_profession')->where('user_id', '=', $user_id)->orderBy('total_unfulfilled_factor_yes_from', 'asc' )->get();
                 

$test = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->orderBy('total_unfulfilled_factor_yes_from', 'desc' )
->get();


$test_0s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '0')
//->orderBy('rating', 'desc' )
->get();
if (count($test_0s) != 0) {
	foreach ($test_0s as  $test_0) 
	{
		if (($test_0->prof_gender == $user_gender)  ||  ($test_0->prof_gender == "no")) 

		{


			$prof_all_conditions = new prof_all_conditions;
			$prof_all_conditions->user_id =  $test_0->user_id;
			$prof_all_conditions->prof_id =  $test_0->prof_id;
			$prof_all_conditions->prof_title =  $test_0->prof_title;
			$prof_all_conditions->rating =  $test_0->rating;
			$prof_all_conditions->prof_level =  $test_0->prof_level;
			$prof_all_conditions->save();
				
		}
	}
}




$test_1s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '1')
//->orderBy('rating', 'desc' )
->get();

if (count($test_1s) != 0) {
	foreach ($test_1s as  $test_1) 
	{
		if (($test_1->prof_gender == $user_gender)  ||  ($test_1->prof_gender == "no")) 

		{
	
	$prof_no_1_conditions = new prof_no_1_conditions;
	$prof_no_1_conditions->user_id =  $test_1->user_id;
	$prof_no_1_conditions->prof_id =  $test_1->prof_id;
	$prof_no_1_conditions->prof_title =  $test_1->prof_title;
	$prof_no_1_conditions->rating =  $test_1->rating;
	$prof_no_1_conditions->theme_num =  $test_1->array_unfulfilled_json_from;
	$prof_no_1_conditions->prof_level =  $test_1->prof_level;
	$prof_no_1_conditions->save();
		}
	}
}

$test_2s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '2')
//->orderBy('rating', 'desc' )
->get();

if (count($test_2s) != 0) {
	foreach ($test_2s as  $test_2) 
	{
		if (($test_2->prof_gender == $user_gender)  ||  ($test_2->prof_gender == "no")) 

		{
	
	$prof_no_2_conditions = new prof_no_2_conditions;
	$prof_no_2_conditions->user_id =  $test_2->user_id;
	$prof_no_2_conditions->prof_id =  $test_2->prof_id;
	$prof_no_2_conditions->prof_title =  $test_2->prof_title;
	$prof_no_2_conditions->rating =  $test_2->rating;
	$prof_no_2_conditions->theme_num =  $test_2->array_unfulfilled_json_from;
	$prof_no_2_conditions->prof_level =  $test_2->prof_level;
	$prof_no_2_conditions->save();
		}
	}
}

$test_3s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '3')
//->orderBy('rating', 'desc' )
->get();

if (count($test_3s) != 0) {
	foreach ($test_3s as  $test_3) 
	{
	
	if (($test_3->prof_gender == $user_gender)  ||  ($test_3->prof_gender == "no")) 

		{
	$prof_no_3_conditions = new prof_no_3_conditions;
	$prof_no_3_conditions->user_id =  $test_3->user_id;
	$prof_no_3_conditions->prof_id =  $test_3->prof_id;
	$prof_no_3_conditions->prof_title =  $test_3->prof_title;
	$prof_no_3_conditions->rating =  $test_3->rating;
	$prof_no_3_conditions->theme_num =  $test_3->array_unfulfilled_json_from;
	$prof_no_3_conditions->prof_level =  $test_3->prof_level;
	$prof_no_3_conditions->save();
		}
	}
}

$test_4s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '4')
//->orderBy('rating', 'desc' )
->get();

if (count($test_4s) != 0) {
	foreach ($test_4s as $test_4) 
	{
	if (($test_4->prof_gender == $user_gender)  ||  ($test_4->prof_gender == "no")) 

		{
	$prof_no_4_conditions = new prof_no_4_conditions;
	$prof_no_4_conditions->user_id =  $test_4->user_id;
	$prof_no_4_conditions->prof_id =  $test_4->prof_id;
	$prof_no_4_conditions->prof_title =  $test_4->prof_title;
	$prof_no_4_conditions->rating =  $test_4->rating;
	$prof_no_4_conditions->theme_num =  $test_4->array_unfulfilled_json_from;
	$prof_no_4_conditions->prof_level =  $test_4->prof_level;
	$prof_no_4_conditions->save();
		}
	}
}

$test_5s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '5')
//->orderBy('rating', 'desc' )
->get();

if (count($test_5s) != 0) {
	foreach ($test_5s as $test_5) 
	{
	if (($test_5->prof_gender == $user_gender)  ||  ($test_5->prof_gender == "no")) 

		{
	$prof_no_5_conditions = new prof_no_5_conditions;
	$prof_no_5_conditions->user_id =  $test_5->user_id;
	$prof_no_5_conditions->prof_id =  $test_5->prof_id;
	$prof_no_5_conditions->prof_title =  $test_5->prof_title;
	$prof_no_5_conditions->rating =  $test_5->rating;
	$prof_no_5_conditions->theme_num =  $test_5->array_unfulfilled_json_from;
	$prof_no_5_conditions->prof_level =  $test_5->prof_level;
	$prof_no_5_conditions->save();
		}
	}
}

$test_6s = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->where('total_unfulfilled_factor_yes_from', '=', '6')
//->orderBy('rating', 'desc' )
->get();

if (count($test_6s) != 0) {
	foreach ($test_6s as $key => $test_6) 
	{
	if (($test_6->prof_gender == $user_gender)  ||  ($test_6->prof_gender == "no")) 

		{
	$prof_no_6_conditions = new prof_no_6_conditions;
	$prof_no_6_conditions->user_id =  $test_6->user_id;
	$prof_no_6_conditions->prof_id =  $test_6->prof_id;
	$prof_no_6_conditions->prof_title =  $test_6->prof_title;
	$prof_no_6_conditions->rating =  $test_6->rating;
	$prof_no_6_conditions->theme_num =  $test_6->array_unfulfilled_json_from;
	$prof_no_6_conditions->prof_level =  $test_6->prof_level;
	$prof_no_6_conditions->save();
		}
	}
}

dump($test_0s);
dump($test_1s);
dump($test_2s);
dump($test_3s);
dump($test_4s);
dump($test_5s);
dump($test_6s);

//dd('готово');

                          //  $profession = UsersProfessions:

                        //    $sql = DB::select('SELECT  MAX(total_executed) AS total_executed FROM user_profession ',  ['user_id' => $user_id]);


                          // dd($profession1);

                            //dd($tables);
return redirect('table');
                           // return view('tablev2', compact('tables', 'professions'));

                        }


    public function table()
                        {
                            $user_id = Auth::id();
                            $user = User::find($user_id);
                            $user_gender = $user->gender;

$tables = DB::table('user_profession')
->where('user_id', '=', $user_id)
->where('total_unfulfilled_factor_yes_before', '=', '0')
->orderBy('rating', 'desc' )
->get();

//////////////////
$prof_level_prof_all_conditions = DB::table('prof_all_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_all_conditions) != 0) {
	
	$prof_all_conditions = DB::table('prof_all_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_all_conditions = DB::table('prof_all_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}
//////////////


$prof_level_prof_no_1_conditions = DB::table('prof_no_1_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_no_1_conditions) != 0) {
	
	$prof_no_1_conditions = DB::table('prof_no_1_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_no_1_conditions = DB::table('prof_no_1_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}


/////////////


$prof_level_prof_no_2_conditions = DB::table('prof_no_2_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_no_2_conditions) != 0) {
	
	$prof_no_2_conditions = DB::table('prof_no_2_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_no_2_conditions = DB::table('prof_no_2_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}



//////////

/////////////


$prof_level_prof_no_3_conditions = DB::table('prof_no_3_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_no_3_conditions) != 0) {
	
	$prof_no_3_conditions = DB::table('prof_no_3_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_no_3_conditions = DB::table('prof_no_3_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}



//////////


/////////////


$prof_level_prof_no_4_conditions = DB::table('prof_no_4_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_no_4_conditions) != 0) {
	
	$prof_no_4_conditions = DB::table('prof_no_4_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_no_4_conditions = DB::table('prof_no_4_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}



//////////



/////////////


$prof_level_prof_no_5_conditions = DB::table('prof_no_5_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_no_5_conditions) != 0) {
	
	$prof_no_5_conditions = DB::table('prof_no_5_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_no_5_conditions = DB::table('prof_no_5_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}



//////////

/////////////


$prof_level_prof_no_6_conditions = DB::table('prof_no_6_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '=', "1")
->get();

if (count($prof_level_prof_no_6_conditions) != 0) {
	
	$prof_no_6_conditions = DB::table('prof_no_6_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "3")
->orderBy('rating', 'desc' )
->get();

}
else
{
		$prof_no_6_conditions = DB::table('prof_no_6_conditions')
->where('user_id', '=', $user_id)
->where('prof_level', '!=', "1")
->orderBy('rating', 'desc' )
->get();
}



//////////

                            return view('tablev2', compact('tables', 
                            	'prof_all_conditions', 
                            	'prof_no_1_conditions', 
                            	'prof_no_2_conditions', 
                            	'prof_no_3_conditions', 
                            	'prof_no_4_conditions', 
                            	'prof_no_5_conditions', 
                            	'prof_no_6_conditions'));
                        }

}
