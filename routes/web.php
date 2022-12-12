<?php

use App\Http\Controllers\AdminLogController;
use App\Http\Controllers\adminPropertyController;
use App\Http\Controllers\adminUserPostController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\FrontPropertyController;
use App\Http\Controllers\frontSearchController;
use App\Http\Controllers\mailingController;
use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';

// admin routes
Route::get('cityhome-admin', function () {
    return view('admin.login');
})->name('adminLogin');

Route::post('cityhome-admin',[AdminLogController::class,'login'])->name('admin.login');
Route::post('adminlogout', [AdminLogController::class, 'logout'])->name('adminLogout');

Route::get('dashboard/subscriber', [adminPropertyController::class, 'subscriber'])->middleware('auth:admin')->name('subscriber');
Route::post('delete-subscriber/{id}', [adminPropertyController::class, 'deleteSubscriber'])->middleware('auth:admin')->name('deleteSubscriber');

Route::get('dashboard/user-management', [adminPropertyController::class, 'user'])->middleware('auth:admin')->name('users');
Route::post('delete-user/{id}', [adminPropertyController::class, 'deleteUser'])->middleware('auth:admin')->name('deleteUser');

Route::get('dashboard/admin-posts', [adminPropertyController::class, 'adminpost'])->middleware('auth:admin')->name('adminpost');

Route::resource('dashboard/user-post', adminUserPostController::class)->middleware('auth:admin');
Route::post('approve-user-post/{id}', [adminUserPostController::class,'approveuserpost'])->middleware('auth:admin')->name('approveUserPost');

Route::resource('dashboard', adminPropertyController::class)->middleware('auth:admin');
Route::post('update-taken/{id}', [adminPropertyController::class,'taken'])->middleware('auth:admin')->name('updateTaken');

// front-end routes
Route::get('terms-and-conditions',[FrontController::class,'condition'])->middleware(['verified'])->name('condition');
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('contact', [FrontController::class, 'contact'])->name('contact');
Route::post('contact-send-mail', [FrontController::class, 'contactMail'])->name('contactMail');
//home search
Route::get('home-search', [frontSearchController::class, 'homeSearch'])->name('homeSearch');
Route::get('home-search/{id}/',[frontSearchController::class,'homeSearchDetail'])->name('homeSearchDetail');

Route::get('property-search',[frontSearchController::class,'propertySearch'])->name('propertySearch');
Route::get('property-search/{id}',[frontSearchController::class,'propertySearchDetail'])->name('propertySearchDetail');

//mailing
Route::post('/share-email',[mailingController::class,'shareEmail'])->name('shareEmail');
Route::post('/request-apply',[mailingController::class,'requestApply'])->name('requestApply');
Route::post('/request-tour',[mailingController::class,'requestTour'])->name('requestTour');


Route::get('account',[FrontPropertyController::class,'index'])->middleware(['verified'])->name('dashboard');
Route::get('account/post-detail/{id}',[FrontPropertyController::class,'show'])->middleware(['verified'])->name('userUploadDestial');
Route::get('account/post-edit/{id}',[FrontPropertyController::class,'edit'])->middleware(['verified'])->name('userUploadEdit');
Route::post('account/post-delete/{id}',[FrontPropertyController::class,'destroy'])->middleware(['verified'])->name('userUploadDelete');
Route::post('account/post-update/{id}',[FrontPropertyController::class,'update'])->middleware(['verified'])->name('userUploadUpdate');

Route::get('upload-post', [FrontPropertyController::class, 'create'])->middleware(['verified'])->name('upload');
Route::post('upload-post', [FrontPropertyController::class, 'store'])->middleware(['verified'])->name('userUpload');

Route::get('user-listings', [FrontController::class, 'userlists'])->name('userlists');
Route::get('user-listings/{id}', [FrontController::class, 'userlistsDetail'])->name('userlistsDetail');

Route::get('property-{salerent}/{category}/', [FrontController::class, 'property']);
Route::get('property-{salerent}/{category}/{id}/', [FrontController::class, 'propertyDetail'])->name('details');

Route::get('{salerent}', [FrontController::class, 'mainProperty'])->name('nameProperty');
Route::get('{salerent}/{id}/', [FrontController::class, 'mainPropertyDetail']);


// subscribe and senf confirmation route
Route::post('subscriber-send-mail', [FrontController::class, 'subscribe'])->name('sub');
Route::get('subscriber-send-mail/mail/confirm/link/sent/{link}/', [FrontController::class, 'confirmSubscribe'])->name('subconfirm');


