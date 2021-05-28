<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\HomeController;
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

    $brands=DB::table('brands')->get();
    return view('home',compact('brands'));
});

/*Route::get('/home', function () {
    return view('welcome');
});*/


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact',[ContactController::class,'index'])->name('con');

/*Route::get('/contact', function () {
    return view('contact');
});*/

//Category Controller
Route::get('category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('category/add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('category/update/{id}',[CategoryController::class,'Update']);
Route::get('category/softdelete/{id}',[CategoryController::class,'SoftDelete']);
Route::get('category/restore/{id}',[CategoryController::class,'restore']);
Route::get('category/pdelete/{id}',[CategoryController::class,'pdelete']);


//brand Controller
Route::get('brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('brand/add',[BrandController::class,'AddBrand'])->name('store.brand');
Route::get('brand/edit/{id}',[BrandController::class,'Edit']);
Route::get('brand/delete/{id}',[BrandController::class,'Delete']);
Route::post('brand/update/{id}',[BrandController::class,'Update']);


//multiimage
Route::get('multi/pic',[BrandController::class,'Multipics'])->name('all.multipic');
Route::post('store/pic',[BrandController::class,'MultipicsShow'])->name('store.multipic');




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

 //   $users=User::all();
    return view('admin.index');
})->name('dashboard');
//Admin All
Route::get('home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');

