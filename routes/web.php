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
Route::resource('/', 'HomeController');
Route::get('/viewTicket/{id}', 'TicketsController@anonymousViewTicketLogged');
Auth::routes();
Route::group(['middleware' => ['auth']], function() {

    Route::resource('/ticketlogs', 'TicketsController');
    Route::get('/ticketlogs', 'TicketsController@index');
    Route::put('/updateticket/{id}', 'TicketsController@update');
    Route::get('/deleteticket/{id}', 'TicketsController@destroy');
    Route::get('/ticketLogId/{id}', 'TicketsController@show');
    Route::get('/changelog', 'TicketsController@auditTraiLog');


    Route::resource('/file-manipulation', 'FileManipulationController');
    Route::put('/file-manipulation', 'FileManipulationController@readUploadedFile');
    Route::get('/fileDeduplicated', 'FileManipulationController@deduplicate');

    Route::resource('/personsInterests', 'PersonalInterestsQueriesController');
    Route::get('/personsInterest', 'PersonalInterestsQueriesController@personalInterests');

});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/login');
})->name('logout');
