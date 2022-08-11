<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RssFeedController;
use App\Http\Controllers\ImportController;
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

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/show/{Post_id}', [PostController::class, 'show']);
Route::post('/savecomment', [PostController::class, 'usercomment'])->name('savecomment');

//All routes which require authentication have been grouped
 Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () { 
   Route::get('/create', [PostController::class, 'create'])->middleware('auth');
    Route::post('/store', [PostController::class, 'store'])->middleware('auth');
    Route::post('/delete/{Post_id}', [PostController::class, 'destroy'])->name('delete')->where('id', '[0-9]+')->middleware('auth');
    Route::get('/edit/{Post_id}', [PostController::class, 'edit'])->middleware('auth');
    Route::post('/update', [PostController::class, 'update'])->middleware('auth');    
    Route::post('/replacepic', [PostController::class, 'changepic'])->middleware('auth');
    Route::get('/importdata', [ImportController::class, 'getImport'])->name('import');
    Route::post('/import_parse', [ImportController::class, 'parseImport'])->name('import_parse');
    Route::post('/import_process', [ImportController::class, 'processImport'])->name('import_process');
}); 

Route::get('/feed', [RssFeedController::class, 'feed']);
