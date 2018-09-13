<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiaryTests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;



class DiaryTestsExcelController extends Controller
{
	public function importExport()
	{
		return view('DiaryTestsImportExport');
	}
	
	public function downloadExcel($type)
	{
		$user_id = Auth::id();
		// $data = DiaryTests::get()->toArray();
		$data = DiaryTests::where([
                        [ 'user_id', '=', $user_id ],
                        ])->get()->toArray();
		return Excel::create('diarytests_excel', function($excel) use ($data) {
			$excel->sheet('myDiary', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	

}