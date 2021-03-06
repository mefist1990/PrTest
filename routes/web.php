<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('my-test', 'HomeController@index')->name('home');
Route::get('/', 'LandingController@landing');


Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

//Route::get('export-import', 'HomeController@exportimport')->name('home');


Route::get('pdftest', 'HomeController@pdftest');
Route::get('pdftesttwo', 'HomeController@pdftesttwo');


Route::get('test', 'HomeController@test');
Route::get('back', 'HomeController@back');
Route::get('skip', 'HomeController@skip');
Route::get('test-back', 'HomeController@testback');
Route::get('reset', 'HomeController@reset');

Route::get('importExport', 'IssuesExcelController@importExport');
Route::get('downloadExcel/{type}', 'IssuesExcelController@downloadExcel');
Route::post('importExcel', 'IssuesExcelController@importExcel');


Route::get('DiaryTestsImportExport', 'DiaryTestsExcelController@importExport');
Route::get('DiaryTestsDownloadExcel/{type}', 'DiaryTestsExcelController@downloadExcel');
Route::post('DiaryTestsImportExcel', 'DiaryTestsExcelController@importExcel');

Route::get('result', 'HomeController@result');

Route::get('pro', 'HomeController@pro');

//Route::post('testalgoritm', 'HomeController@testalgoritm');

Route::post('testalgoritm', 'LogicController@algoritm');

Route::get('professions', 'ProfessionController@index');
Route::post('professions', 'ProfessionController@importExcel');
Route::get('downloadProfessions/{type}', 'ProfessionController@downloadExcel');

Route::get('upup', 'ProfessionController@upup');


Route::get('sql', 'HomeController@sql');


//Route::get('table', 'HomeController@table');
Route::get('table2', 'LogicController@table2');

Route::get('table', 'LogicController@table');

Route::get('del', 'HomeController@del');

Route::get('totalprof', 'HomeController@totalprof');
Route::get('totalprofyes', 'HomeController@total_prof_yes');
Route::get('totalprofno', 'HomeController@total_prof_no');
Route::get('totalfactoryesbefore', 'HomeController@total_factor_yes_before');
Route::get('totalfactoryesfrom', 'HomeController@total_factor_yes_from');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
