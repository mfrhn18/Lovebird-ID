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

/* WELCOME PAGE*/
Route::get('/', function () {
    return view('welcome');
});

/* LOGIN & REGISTER*/
Route::resource('/register',                                'RegisterController');
Route::resource('/login',                                   'LoginController');

/* DASHBOARD */
Route::resource('/home',                                    'HomeController')->middleware('UserCheck');

/* BIRDFARM FEATURES */
Route::get('/birdfarm',                                     'BirdFarmController@index')->middleware('UserCheck');
Route::get('/birdfarm/regbird',                             'BirdFarmController@rbird')->middleware('UserCheck');
Route::post('/birdfarm/regbird/create',                     'BirdFarmController@createbird')->middleware('UserCheck');
Route::get('/birdfarm/reginduk',                            'BirdFarmController@rinduk')->middleware('UserCheck');
Route::post('/birdfarm/reginduk/create',                    'BirdFarmController@createinduk')->middleware('UserCheck');
Route::get('/birdfarm/birddetails/{id}',                    'BirdDetailsController@show')->middleware('UserCheck');
Route::post('/birdfarm/birddetails/dna/{id}',               'BirdDetailsController@dna')->middleware('UserCheck');
Route::get('/birdfarm/birddetails/edit/{id}',               'BirdDetailsController@edit')->middleware('UserCheck');
Route::post('/birdfarm/birddetails/edit/save/{id}',         'BirdDetailsController@store')->middleware('UserCheck');

/* BREEDER FEATURES */
Route::get('/breeder',                                      'BreederController@index')->middleware('UserCheck');
Route::get('/breeder/edit',                                 'BreederController@editbreeder')->middleware('UserCheck');
Route::post('/breeder/edit/save',                           'BreederController@store')->middleware('UserCheck');

/* BREEDING FEATURES */
Route::get('/breeding',                                     'BreedingController@index')->middleware('UserCheck');
Route::get('/breedingdetails/{id}',                         'BreedingDetailsController@show')->middleware('UserCheck');
Route::get('/breedingdetails/batch/{id}',                   'BreedingDetailsController@store')->middleware('UserCheck');
Route::get('/breedingdetails/batch/addrecord/{id}',         'BreedingDetailsController@record')->middleware('UserCheck');
Route::post('/breedingdetails/batch/addrecord/add/{id}',    'BreedingDetailsController@recstore')->middleware('UserCheck');
Route::get('/breedingdetails/batch/closebatch/{id}',        'BreedingDetailsController@closebatch')->middleware('UserCheck');

/* FINANCE FEATURES */
Route::get('/finance',                                      'FinanceController@index')->middleware('UserCheck');
Route::get('/finance/journal',                              'JournalController@addjournal')->middleware('UserCheck');
Route::post('/finance/journal/create',                      'JournalController@createjournal')->middleware('UserCheck');
Route::get('/finance/journal/{id}',                         'JournalController@show')->middleware('UserCheck');
Route::post('/finance/journal/transaction/add/{id}',        'JournalController@createtx')->middleware('UserCheck');
Route::post('/finance/transaction/add',                     'FinanceController@createtrx')->middleware('UserCheck');

/* GALLERY FEATURES */
Route::get('/gallery',                                      'GalleryController@index')->middleware('UserCheck');
Route::post('/gallery/addimage',                            'GalleryController@upload')->middleware('UserCheck');