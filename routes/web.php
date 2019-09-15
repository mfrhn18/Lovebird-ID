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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/register', 'RegisterController');
Route::resource('/login', 'LoginController');
Route::resource('/home', 'HomeController')->middleware('UserCheck');
Route::resource('/breeding', 'BreedingController')->middleware('UserCheck');
Route::resource('/birdfarm', 'BirdFarmController')->middleware('UserCheck');
Route::resource('/regbird', 'RegBirdController')->middleware('UserCheck');
Route::resource('/reginduk', 'RegIndukController')->middleware('UserCheck');
Route::resource('/birddetails', 'BirdDetailsController')->middleware('UserCheck');
Route::resource('/editbird', 'EditBirdDetailsController')->middleware('UserCheck');
Route::resource('/breeder', 'BreederController')->middleware('UserCheck');
Route::resource('/editbreeder', 'EditBreederController')->middleware('UserCheck');
Route::resource('/breedingdetails', 'BreedingDetailsController')->middleware('UserCheck');
Route::resource('/finance', 'FinanceController')->middleware('UserCheck');
Route::resource('/finance/addjournal', 'AddJournalController')->middleware('UserCheck');
Route::resource('/journaldetails', 'JournalController')->middleware('UserCheck');
Route::resource('/journaldetails/addtransaction', 'JournalController')->middleware('UserCheck');
Route::resource('/gallery', 'GalleryController')->middleware('UserCheck');
Route::resource('/gallery/addimage', 'AddImageController')->middleware('UserCheck');