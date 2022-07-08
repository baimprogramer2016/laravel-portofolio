<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevMainController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UrsController;

Route::get('/', function () {
    return redirect("/login");
    //return abort(403, 'Yuhuuu... , Salah Halaman..');
});

//auth
Route::get("/login", [LoginController::class, "index"]);
Route::post("/login",[LoginController::class,"login"])->name('login')->middleware('guest');
Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/register', [LoginController::class, "register"]);
Route::post('/register', [LoginController::class, "saveregister"]);
//endauth

//home
Route::get('/home', [HomeController::class,'home'])->middleware('auth');
Route::get('/register-user',[HomeController::class,'register'])->middleware('auth');
Route::post('/register-user',[HomeController::class,'saveregister'])->middleware('auth');
Route::get('/create-job',[HomeController::class,'createjob'])->middleware('auth');
Route::post('/create-job',[HomeController::class,'storejob'])->middleware('auth');
Route::get('/open-job',[HomeController::class, 'openjob'])->middleware('auth');
Route::get('/go-to-invite-user/{id}',[HomeController::class, 'gotoinviteuser'])->middleware('auth');
//endhome


//invite user
Route::get('/dashboard/invite-user',[DashboardController::class,'inviteuser'])->middleware('auth');
Route::post('/dashboard/invite-user',[DashboardController::class,'storeinviteuser'])->middleware('auth');
Route::get('/userautocomplete', [SearchController::class, 'UserAutoComplete'])->name('userautocomplete')->middleware('auth');
Route::get('/job-user-delete/{id}',[DashboardController::class, 'deletejobuser'])->middleware('auth');

//URS
Route::get('/dashboard/urs', [UrsController::class, 'index'])->middleware('auth');
Route::post('/dashboard/urs', [UrsController::class, 'storeurs'])->middleware('auth');
Route::get('/dashboard/urs-list',[UrsController::class, 'listurs'])->middleware('auth');
Route::get('/dashboard/urs-edit/{id}',[UrsController::class, 'editurs'])->middleware('auth');
Route::put('/dashboard/urs-update/{id}',[UrsController::class, 'updateurs'])->middleware('auth');
Route::delete('/dashboard/urs-delete/{id}',[UrsController::class, 'deleteurs'])->middleware('auth');
Route::get('/dashboard/urs-view/{id}',[UrsController::class, 'viewurs'])->middleware('auth');


//Task
Route::get('/dashboard/task',[TaskController::class,'index'])->middleware('auth');
Route::get('/dashboard/task-create',[TaskController::class, 'create'])->middleware('auth');
Route::post('/dashboard/task-save',[TaskController::class,'savetask'])->middleware('auth');
Route::get('/dashboard/task-detail/{user_id}',[TaskController::class,'detailtask'])->middleware('auth');

//document
Route::get('/dashboard/document',[DocumentController::class, 'index'])->middleware('auth');
Route::post('/dashboard/document-store', [DocumentController::class , 'documentstore'])->middleware('auth');
Route::delete('/dashboard/document-delete/{id}', [DocumentController::class, 'documentdelete'])->middleware('auth');


//enddashboard

//for user
Route::get('/developer', [DevMainController::class,'index'])->middleware('auth');
Route::get('/developer/open-job', [DevMainController::class,'openjob'])->middleware('auth');
