<?php

use App\Http\Controllers\clientsController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\alumniController;
use App\Http\Controllers\authAdminController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\configController;
use App\Http\Controllers\lokerController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\postinganController;
use App\Http\Controllers\tahunController;
use App\Http\Controllers\importController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



/* ---------------------------
    Clients Routing
-------------------------- */

Route::get('/', [clientsController::class, 'home'])->name('clients.home');
Route::get('/lowongan', [clientsController::class, 'lowongan'])->name('clients.loker');
Route::get('/lowongan/{id}', [clientsController::class, 'lowonganDetail'])->name('clients.loker.detail');
Route::get('/patner', [clientsController::class, 'patner'])->name('clients.patner');
Route::get('/blog', [clientsController::class, 'blog'])->name('blog');
Route::get('/blog/detail/{id}', [clientsController::class, 'blogDetail'])->name('blog.detail');
Route::get('/webconfig', [adminController::class, 'getConfigWeb'])->name('configWeb');


// Auth Login
Route::prefix('/admin/2/bkk')->group(function () {
    Route::get('/login', [authAdminController::class, 'index'])->name('login');
    Route::post('/login', [authAdminController::class, 'post'])->name('login');
    Route::get('/logout', [authAdminController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => '/admin/2/bkk', 'middleware' => ['authAdmin']], function () {
    // Route::get('/', [adminController::class, 'home'])->name('admin.home');
    // Partner Routing
    Route::get('/perusahaan', [companyController::class, 'patner'])->name('admin.patner');
    Route::post('/perusahaan', [companyController::class, 'patnerPost'])->name('admin.patner');
    Route::post('/perusahaan/upd', [companyController::class, 'patnerEdit'])->name('admin.patner.edit');
    Route::post('/perusahaan/del', [companyController::class, 'patnerDel'])->name('admin.patner.del');

    // Loker Routing
    Route::get('/loker', [lokerController::class, 'index'])->name('admin.loker');
    Route::get('/loker/create', [lokerController::class, 'createIndex'])->name('admin.loker.create');
    Route::post('/loker/create', [lokerController::class, 'createPost'])->name('admin.loker.create');
    Route::post('/loker/delete', [lokerController::class, 'delete'])->name('admin.loker.delete');
    Route::get('/loker/edit/{id}', [lokerController::class, 'edit'])->name('admin.loker.edit');
    Route::post('/loker/edit', [lokerController::class, 'editPost'])->name('admin.loker.edit.post');


    // Tahun Lulus Routing
    Route::get('/tahun', [tahunController::class, 'tahunIndex'])->name('admin.tahun');
    Route::post('/tahun', [tahunController::class, 'tahunCreate'])->name('admin.tahun');
    Route::post('/tahun/edit', [tahunController::class, 'tahunEdit'])->name('admin.tahun.edit');
    Route::post('/tahun/delete', [tahunController::class, 'tahunDelete'])->name('admin.tahun.delete');

    // Alumni Routing
    Route::get('/alumni', [alumniController::class, 'alumniIndex'])->name('admin.alumni');
    Route::post('/alumni', [alumniController::class, 'alumniCreate'])->name('admin.alumni');
    Route::post('/alumni/edit', [alumniController::class, 'alumniEdit'])->name('admin.alumni.edit');
    Route::post('/alumni/delete', [alumniController::class, 'alumniDelete'])->name('admin.alumni.delete');
    // Route::post('/alumni/upload', [importController::class, 'upload'])->name('admin.import');

    // Post Routing
    Route::get('/post', [postinganController::class, 'index'])->name('admin.post');
    Route::get('/post/create', [postinganController::class, 'createIndex'])->name('admin.post.create');
    Route::post('/post/create', [postinganController::class, 'createPost'])->name('admin.post.create');
    Route::get('/post/edit/{id}', [postinganController::class, 'editIndex'])->name('admin.post.edit');
    Route::post('/post/edit', [postinganController::class, 'editPost'])->name('admin.post.edit.post');
    Route::post('/post/delete', [postinganController::class, 'delete'])->name('admin.post.delete');

    // Setting Routing
    Route::get('/settings', [adminController::class, 'setIndex'])->name('admin.setting');
    Route::post('/settings', [adminController::class, 'setPost'])->name('admin.setting');
    Route::get('/setting/page', [pageController::class, 'index'])->name('admin.setting.page');
    Route::get('/setting/page/edit/{id}', [pageController::class, 'getEdit'])->name('admin.setting.page.edit');
    Route::post('/setting/page/edit/post', [pageController::class, 'postEdit'])->name('admin.setting.page.post');

    // Base Config Routing
    Route::get('/baseconfig', [configController::class, 'index'])->name('admin.baseconfig');
    Route::post('/baseconfig', [configController::class, 'post'])->name('admin.baseconfig');

    // extra routing
    Route::post('/ckeditor', [adminController::class, 'ckeditor'])->name('ckeditor');
    Route::get('/', [adminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/alumni/import', [importController::class, 'index'])->name('admin.import');
    Route::post('/alumni/import', [importController::class, 'post'])->name('admin.import.post');
    Route::get('/format', [importController::class, 'format'])->name('format.download');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    Artisan::call('migrate');
});
