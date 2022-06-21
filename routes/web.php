<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JocController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ValoracioController;

Route::get('/', function () {
    return view('home');
});

Route::get('/jocs', function () {
    return view('jocs.jocs');
})->middleware('auth');;

Route::get('/sales', function () {
    return view('sales.sales');
})->middleware('auth');

Route::get('/reserves', function () {
    return view('reserves.reserves');
})->middleware('auth');

Route::get('/valoracions', function () {
    return view('valoracions.valoracions');
})->middleware('auth');

Auth::routes();

Route::resource('/joc', JocController::class)->middleware('auth');

Route::resource('/sala', SalaController::class)->middleware('auth');

Route::resource('/reserva', ReservaController::class)->middleware('auth');

Route::resource('/valoracio', ValoracioController::class)->middleware('auth');

//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/home', HomeController::class);
