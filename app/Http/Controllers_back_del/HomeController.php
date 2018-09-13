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

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
                        public function landing()
                        {

                            return view('landing.index');

                        }



                        public function index()
                        {

                            $user_id = Auth::id();
                            $issues_all = Issues::all();

                             $issues_result = 170;
                            $counter = Auth::user()->counter;
                            if ($counter == 1) {

                                $rand_issues = rand(1, $issues_result);


                                $issues = Issues::find($rand_issues);
                           // dd($issues);



                                $issues_all = Issues::all();

                                return view('admin-panel.home', compact('issues', 'issues_result', 'counter'));
                            }
                            elseif ($counter > $issues_result ) {
                                $skip_diarytests = DiaryTests::where([
                                    [ 'user_id', '=', $user_id ],
                                    [ 'answer', '=', 'skip' ],
                                    ])->get();
                                $skip_diarytests_count = count($skip_diarytests);
                                if ($skip_diarytests_count == 0) {
                                  
                                $last_question_id = Auth::user()->last_question_id;
                      

                                $issues = Issues::find($last_question_id);
                      
                                $issues_all = Issues::all();
                                
     


                     
                                return view('admin-panel.home', compact('issues', 'issues_result', 'counter'));

                                }
                                $skip_diarytests_id = $skip_diarytests[0]->id;
                                $issues_id = $skip_diarytests[0]->issues_id;
                                $issues = Issues::find($issues_id);
                                return view('skip', compact('issues_result', 'counter', 'issues', 'skip_diarytests_id'));
                                 }

                            else {
                                $last_question_id = Auth::user()->last_question_id;


                                $issues = Issues::find($last_question_id);

                                $issues_all = Issues::all();

                                return view('admin-panel.home', compact('issues', 'issues_result', 'counter'));
                            }
                            

                        }









public function test(Request $request)
    {

        set_time_limit(999999999);

        dd($request);



        $issues_result = 170; 
        $counter = $request->input('counter');

        $issues_id = $request->input('issues_id'); 
        $answer = $request->input('answer');
        

        $categories = Categories::all(); 
        $user_id = Auth::id();
        $categories_count = count($categories);

                                                                                
        $issues2 = Issues::find($issues_id);
                                                                                
        $diarytests = new DiaryTests();
        $diarytests->user_id = Auth::id(); //получаю id пользователя и сохраняем
        $diarytests->categories_issues_id = $issues2->categories_id; //получаю id категории и сохраняю
        $diarytests->answer = $request->answer; //получаю значение ответа пользователя
        $diarytests->issues_id = $issues_id; //получаю значение id вопроса и сохраняю его
        $diarytests->save();
       


        for ($i=0; ; $i++) 

                { 
                    
                    $rand_cat = rand(1, $categories_count);

                    $user_diarytests = DiaryTests::where([
                        [ 'user_id', '=', $user_id ],
                        [ 'categories_issues_id', '=', $rand_cat ],
                        ])->get();
                    $user_diarytests_count = count($user_diarytests);

                        if ($user_diarytests_count < 5) 

                                {
                                    
                                    $search_issues = Issues::where('categories_id', $rand_cat)->get(); 
                                    $search_issues = $search_issues->shuffle();
                                    $search_issues->all();
   
                                        foreach ($search_issues as $search_issue_key => $search_issue) 

                                                {
                                                    $search_issue_id = $search_issue->id;

                                                    $user_diarytests_issue = DiaryTests::where([
                                                        [ 'user_id', '=', $user_id ],
                                                        [ 'issues_id', '=', $search_issue_id ],
                                                        ])->get();

                                                    $user_diarytests_issue_count = count($user_diarytests_issue);

                                                        if ($user_diarytests_issue_count == 0) 

                                                                {


                                                                    

                                                                    if ($user_diarytests_issue_count == 0)  

                                                                            {

                                                                                $issues = Issues::find($search_issue_id);
                                                                                $counter = $counter+1;

                                                                                $user = User::find($user_id);
                                                                                $user->counter = $counter;
                                                                                $user->back_question_id = $issues_id;
                                                                                $user->last_question_id = $search_issue_id;
                                                                                $user->save();
                                                                                        if ($counter > $issues_result ) {
                                                                                                  return redirect()->route('home');
                                                                                                }

                                                                                return view('admin-panel.home', compact('issues', 'issues_result', 'counter' ));
                                                                            }
                                                                    
                                                                }
                                                }

                                }
                                
                }



             
    }





public function back(Request $request)
    {

        $counter = $request->input('counter');
        $issues_result = 170;
        $user_id = Auth::id();
        $user = User::find($user_id);
        $issues_id = $user->back_question_id;
        $issues = Issues::find($issues_id);
        $counter = $counter-1;


        return view('admin-panel.back', compact('issues', 'issues_result', 'counter' ));
    }


public function testback(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $issues_result = 170; 
        
        $issues_id = $user->back_question_id;

        $answer = $request->input('answer');
        
        $user_diarytests = DiaryTests::where([
                        [ 'user_id', '=', $user_id ],
                        [ 'issues_id', '=', $issues_id ],
                        ])->get();
        
        $user_diarytests_id = $user_diarytests[0]->id;
        
        $diarytests = DiaryTests::find($user_diarytests_id);
        $diarytests->answer = $answer;
        $diarytests->save();

       



          $counter = Auth::user()->counter;

          $last_question_id = Auth::user()->last_question_id;


          $issues = Issues::find($last_question_id);

                                return view('testback', compact('issues', 'issues_result', 'counter'));
    }


    public function skip(Request $request)
    {



        $issues_id = $request->input('issues_id'); 
        $answer = $request->input('answer');
        $skip_diarytests_id = $request->input('skip_diarytests_id');
        
        $diarytests = DiaryTests::find($skip_diarytests_id);
        $diarytests->answer = $answer;
        $diarytests->save();
        return redirect()->route('home');
    }



    public function reset()
    {

        $user_id = Auth::id();
        $user_diarytests = DiaryTests::where([
                        [ 'user_id', '=', $user_id ],
                        ])->get();

        $user = User::find($user_id);
        $user->counter = 1;
        $user->back_question_id = 1;
        $user->last_question_id = 1;
        $user->save();
        foreach ($user_diarytests as $user_diarytest)
        {
          $diarytests_id = $user_diarytest->id;
          $diarytests = DiaryTests::find($diarytests_id);
          $diarytests->delete();
        }

        $user_results  = Result::where([
                                    [ 'user_id', '=', $user_id ]
                                    ])->get();
        $user_result_count = count($user_results);

        if ($user_result_count != 0)
        {

                foreach ($user_results as $user_result)
            {
              $user_result_id = $user_result->id;
              $result = DiaryTests::find($user_result_id);
              $result->delete();
            }

        }
        return view('DiaryTestsImportExport');
    }


    public function result()
    {

        $user_id = Auth::id();
                                   //здесь будем делать подсчет результатов
                                $categories_1 = 0;
                                $categories_2 = 0;
                                $categories_3 = 0;
                                $categories_4 = 0;
                                $categories_5 = 0;
                                $categories_6 = 0;
                                $categories_7 = 0;
                                $categories_8 = 0;
                                $categories_9 = 0;
                                $categories_10 = 0;
                                $categories_11 = 0;
                                $categories_12 = 0;
                                $categories_13 = 0;
                                $categories_14 = 0;
                                $categories_15 = 0;
                                $categories_16 = 0;
                                $categories_17 = 0;
                                $categories_18 = 0;
                                $categories_19 = 0;
                                $categories_20 = 0;
                                $categories_21 = 0;
                                $categories_22 = 0;
                                $categories_23 = 0;
                                $categories_24 = 0;
                                $categories_25 = 0;
                                $categories_26 = 0;
                                $categories_27 = 0;
                                $categories_28 = 0;
                                $categories_29 = 0;
                                $categories_30 = 0;
                                $categories_31 = 0;
                                $categories_32 = 0;
                                $categories_33 = 0;
                                $categories_34 = 0;

                                $user_result  = Result::where([
                                    [ 'user_id', '=', $user_id ]
                                    ])->get();
                                $user_result_count = count($user_result);

if ($user_result_count == 0) {


                                for ($x = 1; $x <= 34; $x++) 
                                    {
                                        
                                         $results_diarytests2 = DiaryTests::where([
                                    [ 'user_id', '=', $user_id ],
                                    [ 'categories_issues_id', '=', $x ],
                                    ])->get();

                                         

                                         if ($x == 1) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_1 = $categories_1 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 1) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_1 = $categories_1 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 2) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_2 = $categories_2 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 3) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_3 = $categories_3 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 4) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_4 = $categories_4 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 5) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_5 = $categories_5 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 6) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_6 = $categories_6 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 7) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_7 = $categories_7 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 8) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_8 = $categories_8 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 9) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_9 = $categories_9 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 10) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_10 = $categories_10 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 11) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_11 = $categories_11 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 12) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_12 = $categories_12 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 13) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_13 = $categories_13 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 14) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_14 = $categories_14 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 15) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_15 = $categories_15 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 16) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_16 = $categories_16 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 17) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_17 = $categories_17 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 18) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_18 = $categories_18+ $user_answer;
                                            }
                                         }

                                                                                 if ($x == 19) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_19 = $categories_19 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 20) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_20 = $categories_20 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 21) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_21 = $categories_21 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 22) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_22 = $categories_22 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 23) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_23 = $categories_23 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 24) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_24 = $categories_24 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 25) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_25 = $categories_25 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 26) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_26 = $categories_26 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 27) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_27 = $categories_27 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 28) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_28 = $categories_28 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 29) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_29 = $categories_29 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 30) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_30 = $categories_30 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 31) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_31 = $categories_31 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 32) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_32 = $categories_32 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 33) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_33 = $categories_33 + $user_answer;
                                            }
                                         }

                                                                                 if ($x == 34) 
                                         {
                                            
                                            foreach ($results_diarytests2 as  $results_diarytest2) {
                                                $user_answer = $results_diarytest2->answer;
                                                $categories_34 = $categories_34 + $user_answer;
                                            }
                                         }



                                    }


                                    $result = new Result();
                                    $result->user_id = $user_id; 
                                //  $result->factor = "NO";
                                //  $result->value_from = "NO";
                                //  $result->value_before = "NO";
                                    $result->gender = "NO";



                                    $result->categories_1 = $categories_1;
                                    $result->categories_2 = $categories_2;
                                    $result->categories_3 = $categories_3;
                                    $result->categories_4 = $categories_4;
                                    $result->categories_5 = $categories_5;
                                    $result->categories_6 = $categories_6;
                                    $result->categories_7 = $categories_7;
                                    $result->categories_8 = $categories_8;
                                    $result->categories_9 = $categories_9;
                                    $result->categories_10 = $categories_10;
                                    $result->categories_11 = $categories_11;
                                    $result->categories_12 = $categories_12;
                                    $result->categories_13 = $categories_13;
                                    $result->categories_14 = $categories_14;
                                    $result->categories_15 = $categories_15;
                                    $result->categories_16 = $categories_16;
                                    $result->categories_17 = $categories_17;
                                    $result->categories_18 = $categories_18;
                                    $result->categories_19 = $categories_19;
                                    $result->categories_20 = $categories_20;
                                    $result->categories_21 = $categories_21;
                                    $result->categories_22 = $categories_22;
                                    $result->categories_23 = $categories_23;
                                    $result->categories_24 = $categories_24;
                                    $result->categories_25 = $categories_25;
                                    $result->categories_26 = $categories_26;
                                    $result->categories_27 = $categories_27;
                                    $result->categories_28 = $categories_28;
                                    $result->categories_29 = $categories_29;
                                    $result->categories_30 = $categories_30;
                                    $result->categories_31 = $categories_31;
                                    $result->categories_32 = $categories_32;
                                    $result->categories_33 = $categories_33;
                                    $result->categories_34 = $categories_34;




                                    $result->save();
                                    echo "Готово, данные подсчитаны";

                                }   
                                    else
                                    {
                                        echo "Ошибка, подсчета не было";
                                    }
                                    

    }
    




                    public function pro()
                        {



                                return view('pro');
                                                        

                        }

                    
                    public function testalgoritm(Request $request)
                        {
                           // DB::table('coinprofessions')->truncate(); 
                            $user_id = Auth::id();
                            $table = DB::table('coinprofessions')->where('user_id', '=', $user_id)->delete();
                            $user_prof_del = DB::table('user_profession')->where('user_id', '=', $user_id)->delete();
                            $professions = Professions::all();
                            foreach ($professions as $profession) {
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

                                if ($profession->factor_cat_1 == "yes" or $profession->factor_cat_1 == "no") {
                                    
                                    if (($profession->value_from_cat_1 < $request->theme1) && ($request->theme1 < $profession->value_before_cat_1)) 
                                        {
                                        
                                                $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_1; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;

                                    if ($profession->factor_cat_1 == "yes") {
                                        
                                        $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                    }

                                    if ($profession->factor_cat_1 == "no") {
                                        
                                        $total_executed_factor_no = $total_executed_factor_no + 1;
                                    }

                                        if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 == 0)) 
                                            {
                                            $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                            }
                                                
                                        //echo $profession->title . " подходит " . $request->theme1 . "<br>";
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1;

                                        if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }


if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 != 0)) {
                                        $array_unfulfille_1 = array('1');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_1);
                                        }
                                        


                                            if ($profession->factor_cat_1 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_1 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }


                                    }

                                    
                                }

                               
                               if ($profession->factor_cat_2 == "yes" or $profession->factor_cat_2 == "no") {
                                    
                                    if (($profession->value_from_cat_2 < $request->theme2) && ($request->theme2 < $profession->value_before_cat_2)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_2; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;

                                    if ($profession->factor_cat_2 == "yes") {
                                        
                                        $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                    }

                                    if ($profession->factor_cat_2 == "no") {
                                        
                                        $total_executed_factor_no = $total_executed_factor_no + 1;

                                            if ($profession->factor_cat_2 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_2 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                    if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
                                        }

                                        //echo $profession->title . " подходит " . $request->theme2 . "<br>";
                                    }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1;


                                        if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }


if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 != 0)) {
                                        $array_unfulfille_2 = array('2');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_2);
                                        }

                                            if ($profession->factor_cat_2 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_2 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }

                                                                        
                                }

                                if ($profession->factor_cat_3 == "yes" or $profession->factor_cat_3 == "no") {
                                    
                                    if (($profession->value_from_cat_3 < $request->theme3) && ($request->theme3 < $profession->value_before_cat_3)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_3; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        if ($profession->factor_cat_3 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_3 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    }

                                    if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before+1;
                                        }

                                    else
                                    {
                                        $total_unfulfilled = $total_unfulfilled +1;

                                         if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 == 0)) 
                                        {
                                        
                                        $total_unfulfilled_factor_yes_before = $total_unfulfilled_factor_yes_before + 1;
                                        
                                        }

if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 != 0)) {
                                        $array_unfulfille_3 = array('3');
                                        $array_unfulfilled = array_merge($array_unfulfilled, $array_unfulfille_3);
                                        }

                                            if ($profession->factor_cat_3 == "yes") {
                                            
                                            $total_unfulfilled_factor_yes = $total_unfulfilled_factor_yes + 1;
                                            }

                                            if ($profession->factor_cat_3 == "no") {
                                                
                                                $total_unfulfilled_factor_no = $total_unfulfilled_factor_no + 1;
                                            }
                                    }


                                }

                                if ($profession->factor_cat_4 == "yes" or $profession->factor_cat_4 == "no") {
                                    
                                    if (($profession->value_from_cat_4 < $request->theme4) && ($request->theme4 < $profession->value_before_cat_4)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_4; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        
                                        if ($profession->factor_cat_4 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_4 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }

                                    }

                                    if (($profession->factor_cat_4 == "yes") && ($profession->value_from_cat_4 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_5 == "yes" or $profession->factor_cat_5 == "no") {
                                    
                                    if (($profession->value_from_cat_5 < $request->theme5) && ($request->theme5 < $profession->value_before_cat_5)) {
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

                                    }

                                    if (($profession->factor_cat_5 == "yes") && ($profession->value_from_cat_5 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_6 == "yes" or $profession->factor_cat_6 == "9") {
                                    
                                    if (($profession->value_from_cat_6 < $request->theme6) && ($request->theme6 < $profession->value_before_cat_6)) {
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

                                    }

                                    if (($profession->factor_cat_6 == "yes") && ($profession->value_from_cat_6 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_7 == "yes" or $profession->factor_cat_7 == "no") {
                                    
                                    if (($profession->value_from_cat_7 < $request->theme7) && ($request->theme7 < $profession->value_before_cat_7)) {
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


                                    }


                                    if (($profession->factor_cat_7 == "yes") && ($profession->value_from_cat_7 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_8 == "yes" or $profession->factor_cat_8 == "no") {
                                    
                                    if (($profession->value_from_cat_8 < $request->theme8) && ($request->theme8 < $profession->value_before_cat_8)) {
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


                                    }


                                    if (($profession->factor_cat_8 == "yes") && ($profession->value_from_cat_8 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_9 == "yes" or $profession->factor_cat_9 == "no") {
                                    
                                    if (($profession->value_from_cat_9 < $request->theme9) && ($request->theme9 < $profession->value_before_cat_9)) {
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


                                    }


                                    if (($profession->factor_cat_9 == "yes") && ($profession->value_from_cat_9 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_10 == "yes" or $profession->factor_cat_10 == "no") {
                                    
                                    if (($profession->value_from_cat_10 < $request->theme10) && ($request->theme10 < $profession->value_before_cat_10)) {
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


                                    }


                                    if (($profession->factor_cat_10 == "yes") && ($profession->value_from_cat_10 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                if ($profession->factor_cat_11 == "yes" or $profession->factor_cat_11 == "no") {
                                    
                                    if (($profession->value_from_cat_11 < $request->theme11) && ($request->theme11 < $profession->value_before_cat_11)) {
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

                                    }


                                    if (($profession->factor_cat_11 == "yes") && ($profession->value_from_cat_11 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_12 == "yes" or $profession->factor_cat_12 == "no") {
                                    
                                    if (($profession->value_from_cat_12 < $request->theme12) && ($request->theme12 < $profession->value_before_cat_12)) {
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

                                    }


                                    if (($profession->factor_cat_12 == "yes") && ($profession->value_from_cat_12 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_13 == "yes" or $profession->factor_cat_13 == "no") {
                                    
                                    if (($profession->value_from_cat_13 < $request->theme13) && ($request->theme13 < $profession->value_before_cat_13)) {
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

                                    }
                                    


                                    if (($profession->factor_cat_13 == "yes") && ($profession->value_from_cat_13 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_14 == "yes" or $profession->factor_cat_14 == "no") {
                                    
                                    if (($profession->value_from_cat_14 < $request->theme14) && ($request->theme14 < $profession->value_before_cat_14)) {
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

                                    }


                                    if (($profession->factor_cat_14 == "yes") && ($profession->value_from_cat_14 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_15 == "yes" or $profession->factor_cat_15 == "no") {
                                    
                                    if (($profession->value_from_cat_15 < $request->theme15) && ($request->theme15 < $profession->value_before_cat_15)) {
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

                                    }

                                    if (($profession->factor_cat_15 == "yes") && ($profession->value_from_cat_15 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_16 == "yes" or $profession->factor_cat_16 == "no") {
                                    
                                    if (($profession->value_from_cat_16 < $request->theme16) && ($request->theme16 < $profession->value_before_cat_16)) {
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

                                    }

                                    if (($profession->factor_cat_16 == "yes") && ($profession->value_from_cat_16 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_17 == "yes" or $profession->factor_cat_17 == "no") {
                                    
                                    if (($profession->value_from_cat_17 < $request->theme17) && ($request->theme17 < $profession->value_before_cat_17)) {
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


                                    }


                                    if (($profession->factor_cat_17 == "yes") && ($profession->value_from_cat_17 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_18 == "yes" or $profession->factor_cat_18 == "no") {
                                    
                                    if (($profession->value_from_cat_18 < $request->theme18) && ($request->theme18 < $profession->value_before_cat_18)) {
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
                                    }

                                    if (($profession->factor_cat_18 == "yes") && ($profession->value_from_cat_18 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_19 == "yes" or $profession->factor_cat_19 == "no") {
                                    
                                    if (($profession->value_from_cat_19 < $request->theme19) && ($request->theme19 < $profession->value_before_cat_19)) {
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
                                    }


                                    if (($profession->factor_cat_19 == "yes") && ($profession->value_from_cat_19 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_20 == "yes" or $profession->factor_cat_20 == "no") {
                                    
                                    if (($profession->value_from_cat_20 < $request->theme20) && ($request->theme20 < $profession->value_before_cat_20)) {
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


                                    }

                                    if (($profession->factor_cat_20 == "yes") && ($profession->value_from_cat_20 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_21 == "yes" or $profession->factor_cat_21 == "no") {
                                    
                                    if (($profession->value_from_cat_21 < $request->theme21) && ($request->theme21 < $profession->value_before_cat_21)) {
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
                                    }


                                    if (($profession->factor_cat_21 == "yes") && ($profession->value_from_cat_21 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_22 == "yes" or $profession->factor_cat_22 == "no") {
                                    
                                    if (($profession->value_from_cat_22 < $request->theme22) && ($request->theme22 < $profession->value_before_cat_22)) {
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


                                    }


                                    if (($profession->factor_cat_22 == "yes") && ($profession->value_from_cat_22 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_23 == "yes" or $profession->factor_cat_23 == "no") {
                                    
                                    if (($profession->value_from_cat_23 < $request->theme23) && ($request->theme23 < $profession->value_before_cat_23)) {
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


                                    }


                                    if (($profession->factor_cat_23 == "yes") && ($profession->value_from_cat_23 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_24 == "yes" or $profession->factor_cat_24 == "no") {
                                    
                                    if (($profession->value_from_cat_24 < $request->theme24) && ($request->theme24 < $profession->value_before_cat_24)) {
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


                                    }


                                    if (($profession->factor_cat_24 == "yes") && ($profession->value_from_cat_24 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_25 == "yes" or $profession->factor_cat_25 == "no") {
                                    
                                    if (($profession->value_from_cat_25 < $request->theme25) && ($request->theme25 < $profession->value_before_cat_25)) {
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


                                    }


                                    if (($profession->factor_cat_25 == "yes") && ($profession->value_from_cat_25 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_26 == "yes" or $profession->factor_cat_26 == "no") {
                                    
                                    if (($profession->value_from_cat_26 < $request->theme26) && ($request->theme26 < $profession->value_before_cat_26)) {
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


                                    }


                                    if (($profession->factor_cat_26 == "yes") && ($profession->value_from_cat_26 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_27 == "yes" or $profession->factor_cat_27 == "no") {
                                    
                                    if (($profession->value_from_cat_27 < $request->theme27) && ($request->theme27 < $profession->value_before_cat_27)) {
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


                                    }

                                    if (($profession->factor_cat_27 == "yes") && ($profession->value_from_cat_27 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_28 == "yes" or $profession->factor_cat_28 == "no") {
                                    
                                    if (($profession->value_from_cat_28 < $request->theme28) && ($request->theme28 < $profession->value_before_cat_28)) {
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
                                    }


                                    if (($profession->factor_cat_28 == "yes") && ($profession->value_from_cat_28 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_29 == "yes" or $profession->factor_cat_29 == "no") {
                                    
                                    if (($profession->value_from_cat_29 < $request->theme29) && ($request->theme29 < $profession->value_before_cat_29)) {
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
                                    }


                                    if (($profession->factor_cat_29 == "yes") && ($profession->value_from_cat_29 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_30 == "yes" or $profession->factor_cat_30 == "no") {
                                    
                                    if (($profession->value_from_cat_30 < $request->theme30) && ($request->theme30 < $profession->value_before_cat_30)) {
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

                                    }


                                    if (($profession->factor_cat_30 == "yes") && ($profession->value_from_cat_30 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_31 == "yes" or $profession->factor_cat_31 == "no") {
                                    
                                    if (($profession->value_from_cat_31 < $request->theme31) && ($request->theme31 < $profession->value_before_cat_31)) {
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


                                    }


                                    if (($profession->factor_cat_31 == "yes") && ($profession->value_from_cat_31 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_32 == "yes" or $profession->factor_cat_32 == "no") {
                                    
                                    if (($profession->value_from_cat_32 < $request->theme32) && ($request->theme32 < $profession->value_before_cat_32)) {
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


                                    }


                                    if (($profession->factor_cat_32 == "yes") && ($profession->value_from_cat_32 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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



                                if ($profession->factor_cat_33 == "yes" or $profession->factor_cat_33 == "no") {
                                    
                                    if (($profession->value_from_cat_33 < $request->theme33) && ($request->theme33 < $profession->value_before_cat_33)) {
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


                                    }


                                    if (($profession->factor_cat_33 == "yes") && ($profession->value_from_cat_33 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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

                                

                                if ($profession->factor_cat_34 == "yes" or $profession->factor_cat_34 == "no") {
                                    
                                    if (($profession->value_from_cat_34 < $request->theme34) && ($request->theme34 < $profession->value_before_cat_34)) {
                                        $coinprofession = new Coinprofessions;
                                                $coinprofession->user_id = $user_id;
                                                $coinprofession->prof_id = $profession->id; $coinprofession->prof_title = $profession->title; 
                                                $coinprofession->factor = $profession->factor_cat_34; 
                                                $coinprofession->save(); $total_executed = $total_executed +1;
                                        

                                        if ($profession->factor_cat_34 == "yes") {
                                            
                                            $total_executed_factor_yes = $total_executed_factor_yes + 1;
                                        }

                                        if ($profession->factor_cat_34 == "no") {
                                            
                                            $total_executed_factor_no = $total_executed_factor_no + 1;
                                        }


                                    }


                                    if (($profession->factor_cat_34 == "yes") && ($profession->value_from_cat_34 == 0)) 
                                        {
                                        
                                        $total_executed_factor_yes_before = $total_executed_factor_yes_before + 1;
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
                                $array_unfulfilled_json_from =  json_encode($array_unfulfilled);
                                
$total_executed_factor_yes_from = $total_executed_factor_yes - $total_executed_factor_yes_before;

$total_unfulfilled_factor_yes_from = $total_unfulfilled_factor_yes - $total_unfulfilled_factor_yes_before;

                                dump($user_id);
                                dump($profession->id);
                                dump($profession->title);
                                dump($total_executed);
                                dump($total_unfulfilled);
                                dump($total_executed_factor_yes);
                                dump($total_executed_factor_no);
                                dump($total_executed_factor_yes_before);
                                dump($total_unfulfilled_factor_yes);
                                dump($total_unfulfilled_factor_no);
                                dump($total_unfulfilled_factor_yes_before);
                                dump($profession->total);
                                dump($array_unfulfilled_json_from);
                                dump($profession->total_factor_yes);
                                dump($profession->total_factor_yes_before);
                                dump($profession->total_factor_no);



                                dump('-------------');
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

                                
                                $user_profession->save();



                               // echo $profession->title . " количество выполненных - " . $total_executed  . " количество не выполненных - " . $total_unfulfilled . " Общее " . $total . " = " . $profession->total . "Количество выполненных обязытельных " . $total_executed_factor_yes .  "Количество выполненных не обязательных " . $total_executed_factor_no;
                            }

                            dd('Готово');
                           // return redirect('table');
                              
                        }



                        public function table()
                        {
                            $user_id = Auth::id();
                            $tables = DB::table('user_profession')->where('user_id', '=', $user_id)->orderByDesc('total_executed')->get();



                           $professions = DB::table('user_profession')->where('user_id', '=', $user_id)->orderByDesc('total_executed')->get();
                           $profession1 = $professions[0];

                          //  $profession = UsersProfessions:

                        //    $sql = DB::select('SELECT  MAX(total_executed) AS total_executed FROM user_profession ',  ['user_id' => $user_id]);


                          // dd($profession1);

                            //dd($tables);
                            return view('table', compact('tables', 'profession1'));

                        }




                    public function sql()
                        {

$user_id = Auth::id();
$sql = DB::select('SELECT prof_id,COUNT(*) AS total FROM coinprofessions   where user_id = :user_id GROUP BY prof_id ORDER BY total DESC LIMIT 1',  ['user_id' => $user_id]);
$prof_id = $sql[0]->prof_id;

$profession = Professions::find($prof_id);

echo "Ваша профессия - " . $profession->title . " количество совпадений - " . $sql[0]->total;

                        //    dd($profession);
                                                        

                        }


                        public function table_no()
                        {
                            $user_id = Auth::id();
                            $tables = DB::table('coinprofessions')
                            ->where('user_id', '=', $user_id)
                            ->get();



$sql = DB::select('SELECT prof_id,COUNT(*) AS total FROM coinprofessions   where user_id = :user_id GROUP BY prof_id ORDER BY total DESC LIMIT 1',  ['user_id' => $user_id]);
$prof_id = $sql[0]->prof_id;

$profession = Professions::find($prof_id);
$total = $sql[0]->total;

                            //dd($tables);
                            return view('table', compact('tables', 'profession', 'total'));

                        }



                        public function del()
                        {
                        
                            $user_id = Auth::id();
                            $table = DB::table('coinprofessions')->truncate();
                        //  $table = DB::table('coinprofessions')->where('user_id', '=', $user_id)->delete();
                            dd('Готово');

                        }




                        public function totalprof()
                        {
                        
                            
                            $professions = Professions::all();
                            
                            foreach ($professions as $profession) {
                                $total = 0;
                               
                                if ($profession->factor_cat_1 == "yes" or $profession->factor_cat_1 == "no") {
                                    
                                    $total = $total+1;
                                    //dump()
                                }

                               
                               if ($profession->factor_cat_2 == "yes" or $profession->factor_cat_2 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_3 == "yes" or $profession->factor_cat_3 == "no") {
                                    
                                   $total = $total+1;
                                }

                                if ($profession->factor_cat_4 == "yes" or $profession->factor_cat_4 == "no") {
                                    
                                    $total = $total+1;
                                }                                

                                if ($profession->factor_cat_5 == "yes" or $profession->factor_cat_5 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_6 == "yes" or $profession->factor_cat_6 == "9") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_7 == "yes" or $profession->factor_cat_7 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_8 == "yes" or $profession->factor_cat_8 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_9 == "yes" or $profession->factor_cat_9 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_10 == "yes" or $profession->factor_cat_10 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_11 == "yes" or $profession->factor_cat_11 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_12 == "yes" or $profession->factor_cat_12 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_13 == "yes" or $profession->factor_cat_13 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_14 == "yes" or $profession->factor_cat_14 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_15 == "yes" or $profession->factor_cat_15 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_16 == "yes" or $profession->factor_cat_16 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_17 == "yes" or $profession->factor_cat_17 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_18 == "yes" or $profession->factor_cat_18 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_19 == "yes" or $profession->factor_cat_19 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_20 == "yes" or $profession->factor_cat_20 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_21 == "yes" or $profession->factor_cat_21 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_22 == "yes" or $profession->factor_cat_22 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_23 == "yes" or $profession->factor_cat_23 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_24 == "yes" or $profession->factor_cat_24 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_25 == "yes" or $profession->factor_cat_25 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_26 == "yes" or $profession->factor_cat_26 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_27 == "yes" or $profession->factor_cat_27 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_28 == "yes" or $profession->factor_cat_28 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_29 == "yes" or $profession->factor_cat_29 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_30 == "yes" or $profession->factor_cat_30 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_31 == "yes" or $profession->factor_cat_31 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_32 == "yes" or $profession->factor_cat_32 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_33 == "yes" or $profession->factor_cat_33 == "no") {
                                    
                                    $total = $total+1;
                                }

                                

                                if ($profession->factor_cat_34 == "yes" or $profession->factor_cat_34 == "no") {
                                    
                                    $total = $total+1;
                                }

                                echo $profession->title . " " . $total;

                                $prof = Professions::find($profession->id);
                                $prof->total = $total; //получаю id категории и сохраняю
                                $prof->save();

                            }
                            dd('Готово');

                        }



                        public function total_prof_yes()
                        {
                        
                            
                            $professions = Professions::all();
                            
                            foreach ($professions as $profession) {
                                $total = 0;
                               
                                if ($profession->factor_cat_1 == "yes") {
                                    
                                    $total = $total+1;
                                    //dump()
                                }

                               
                               if ($profession->factor_cat_2 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_3 == "yes") {
                                    
                                   $total = $total+1;
                                }

                                if ($profession->factor_cat_4 == "yes") {
                                    
                                    $total = $total+1;
                                }                                

                                if ($profession->factor_cat_5 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_6 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_7 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_8 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_9 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_10 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_11 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_12 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_13 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_14 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_15 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_16 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_17 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_18 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_19 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_20 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_21 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_22 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_23 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_24 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_25 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_26 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_27 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_28 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_29 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_30 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_31 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_32 == "yes") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_33 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                

                                if ($profession->factor_cat_34 == "yes") {
                                    
                                    $total = $total+1;
                                }

                                echo $profession->title . " " . $total;

                                $prof = Professions::find($profession->id);
                                $prof->total_factor_yes = $total; //получаю id категории и сохраняю
                                $prof->save();

                            }
                            dd('Готово');

                        }



                        public function total_prof_no()
                        {
                        
                            
                            $professions = Professions::all();
                            
                            foreach ($professions as $profession) {
                                $total = 0;
                               
                                if ($profession->factor_cat_1 == "no") {
                                    
                                    $total = $total+1;
                                }

                               
                                if ($profession->factor_cat_2 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_3 == "no") {
                                    
                                   $total = $total+1;
                                }

                                if ($profession->factor_cat_4 == "no") {
                                    
                                    $total = $total+1;
                                }                                

                                if ($profession->factor_cat_5 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_6 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_7 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_8 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_9 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_10 == "no") {
                                    
                                    $total = $total+1;
                                }

                                if ($profession->factor_cat_11 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_12 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_13 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_14 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_15 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_16 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_17 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_18 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_19 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_20 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_21 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_22 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_23 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_24 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_25 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_26 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_27 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_28 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_29 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_30 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_31 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_32 == "no") {
                                    
                                    $total = $total+1;
                                }



                                if ($profession->factor_cat_33 == "no") {
                                    
                                    $total = $total+1;
                                }

                                

                                if ($profession->factor_cat_34 == "no") {
                                    
                                    $total = $total+1;
                                }

                                echo $profession->title . " " . $total;

                                $prof = Professions::find($profession->id);
                                $prof->total_factor_no = $total; //получаю id категории и сохраняю
                                $prof->save();

                            }
                            dd('Готово');

                        }





                        public function total_factor_yes_before()
                        {
                        
                            
                            $professions = Professions::all();
                            
                            foreach ($professions as $profession) {
                                $total = 0;
                               
                                if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 == 0)) {
                                    
                                    $total = $total+1;
                                }

                               
                                if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 == 0)) {
                                    
                                   $total = $total+1;
                                }

                                if (($profession->factor_cat_4 == "yes") && ($profession->value_from_cat_4 == 0)) {
                                    
                                    $total = $total+1;
                                }                                

                                if (($profession->factor_cat_5 == "yes") && ($profession->value_from_cat_5 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_6 == "yes") && ($profession->value_from_cat_6 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_7 == "yes") && ($profession->value_from_cat_7 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_8 == "yes") && ($profession->value_from_cat_8 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_9 == "yes") && ($profession->value_from_cat_9 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_10 == "yes") && ($profession->value_from_cat_10 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_11 == "yes") && ($profession->value_from_cat_11 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_12 == "yes") && ($profession->value_from_cat_12 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_13 == "yes") && ($profession->value_from_cat_13 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_14 == "yes") && ($profession->value_from_cat_14 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_15 == "yes") && ($profession->value_from_cat_15 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_16 == "yes") && ($profession->value_from_cat_16 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_17 == "yes") && ($profession->value_from_cat_17 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_18 == "yes") && ($profession->value_from_cat_18 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_19 == "yes") && ($profession->value_from_cat_19 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_20 == "yes") && ($profession->value_from_cat_20 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_21 == "yes") && ($profession->value_from_cat_21 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_22 == "yes") && ($profession->value_from_cat_22 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_23 == "yes") && ($profession->value_from_cat_23 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_24 == "yes") && ($profession->value_from_cat_24 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_25 == "yes") && ($profession->value_from_cat_25 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_26 == "yes") && ($profession->value_from_cat_26 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_27 == "yes") && ($profession->value_from_cat_27 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_28 == "yes") && ($profession->value_from_cat_28 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_29 == "yes") && ($profession->value_from_cat_29 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_30 == "yes") && ($profession->value_from_cat_30 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_31 == "yes") && ($profession->value_from_cat_31 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_32 == "yes") && ($profession->value_from_cat_32 == 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_33 == "yes") && ($profession->value_from_cat_33 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                

                                if (($profession->factor_cat_34 == "yes") && ($profession->value_from_cat_34 == 0)) {
                                    
                                    $total = $total+1;
                                }

                                echo $profession->title . " " . $total;

                                $prof = Professions::find($profession->id);
                                $prof->total_factor_yes_before = $total; //получаю id категории и сохраняю
                                $prof->save();

                            }
                            dd('Готово');

                        }


                        public function total_factor_yes_from()
                        {
                        
                            
                            $professions = Professions::all();
                            
                            foreach ($professions as $profession) {
                                $total = 0;
                               
                                if (($profession->factor_cat_1 == "yes") && ($profession->value_from_cat_1 != 0)) {
                                    
                                    $total = $total+1;
                                }

                               
                                if (($profession->factor_cat_2 == "yes") && ($profession->value_from_cat_2 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_3 == "yes") && ($profession->value_from_cat_3 != 0)) {
                                    
                                   $total = $total+1;
                                }

                                if (($profession->factor_cat_4 == "yes") && ($profession->value_from_cat_4 != 0)) {
                                    
                                    $total = $total+1;
                                }                                

                                if (($profession->factor_cat_5 == "yes") && ($profession->value_from_cat_5 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_6 == "yes") && ($profession->value_from_cat_6 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_7 == "yes") && ($profession->value_from_cat_7 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_8 == "yes") && ($profession->value_from_cat_8 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_9 == "yes") && ($profession->value_from_cat_9 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_10 == "yes") && ($profession->value_from_cat_10 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                if (($profession->factor_cat_11 == "yes") && ($profession->value_from_cat_11 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_12 == "yes") && ($profession->value_from_cat_12 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_13 == "yes") && ($profession->value_from_cat_13 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_14 == "yes") && ($profession->value_from_cat_14 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_15 == "yes") && ($profession->value_from_cat_15 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_16 == "yes") && ($profession->value_from_cat_16 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_17 == "yes") && ($profession->value_from_cat_17 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_18 == "yes") && ($profession->value_from_cat_18 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_19 == "yes") && ($profession->value_from_cat_19 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_20 == "yes") && ($profession->value_from_cat_20 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_21 == "yes") && ($profession->value_from_cat_21 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_22 == "yes") && ($profession->value_from_cat_22 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_23 == "yes") && ($profession->value_from_cat_23 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_24 == "yes") && ($profession->value_from_cat_24 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_25 == "yes") && ($profession->value_from_cat_25 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_26 == "yes") && ($profession->value_from_cat_26 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_27 == "yes") && ($profession->value_from_cat_27 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_28 == "yes") && ($profession->value_from_cat_28 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_29 == "yes") && ($profession->value_from_cat_29 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_30 == "yes") && ($profession->value_from_cat_30 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_31 == "yes") && ($profession->value_from_cat_31 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_32 == "yes") && ($profession->value_from_cat_32 != 0)) {
                                    
                                    $total = $total+1;
                                }



                                if (($profession->factor_cat_33 == "yes") && ($profession->value_from_cat_33 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                

                                if (($profession->factor_cat_34 == "yes") && ($profession->value_from_cat_34 != 0)) {
                                    
                                    $total = $total+1;
                                }

                                echo $profession->title . " " . $total;

                                $prof = Professions::find($profession->id);
                                $prof->total_factor_yes_from = $total; //получаю id категории и сохраняю
                                $prof->save();

                            }
                            dd('Готово');

                        }



}
