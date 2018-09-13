<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issues;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



class IssuesExcelController extends Controller
{
	public function importExport()
	{
		return view('IssuesImportExport');
	}
	
	public function downloadExcel($type)
	{
		$data = Issues::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
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
					$insert[] = ['id' => $value->id, 'title' => $value->title, 'categories_id' => $value->categories_id, 'description' => $value->description];
				}
				if(!empty($insert)){
					DB::table('issues')->insert($insert);
					dd('Insert Record successfully.');
				}
			}
		}
		return back();
	}
}