<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminTopicController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\RegisterController;
use App\Models\Collection;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingPageController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/browse', [BrowseController::class, 'index'])->name('browse');
Route::get('/about', [AboutController::class, 'index']);
Route::post('/about', [AboutController::class, 'store']);
Route::group(['middleware' => 'auth.user'], function () {
    Route::get('/preview/{slug}', [PreviewController::class, 'index']);
    Route::get('/preview/{slug}/copy', [PreviewController::class, 'copy']);


    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/topik', [DashboardController::class, 'materi']);
    Route::get('/dashboard/topik/{slug}/hapus', [DashboardController::class, 'materi_hapus']);
    Route::get('/dashboard/topik/tambah', [DashboardController::class, 'tambah_materi']);
    Route::post('/dashboard/topik/tambah', [DashboardController::class, 'post_tambah_materi']);
    Route::get('/dashboard/topik/{slug}/edit', [DashboardController::class, 'materi_edit']);
    Route::post('/dashboard/topik/{slug}/edit', [DashboardController::class, 'post_materi_edit']);
    Route::get('/dashboard/topik/{slug}', [DashboardController::class, 'materi_package']);
    Route::get('/dashboard/topik/{slug}/input', [DashboardController::class, 'input_materi_package']);
    Route::post('/dashboard/topik/{slug}/input', [DashboardController::class, 'post_input_materi_package']);
    Route::get('/dashboard/topik/{slug}/{id}/hapus', [DashboardController::class, 'slide_hapus']);
    Route::get('/dashboard/topik/{slug}/{id}/edit', [DashboardController::class, 'slide_edit']);
    Route::post('/dashboard/topik/{slug}/{id}/edit', [DashboardController::class, 'slide_edit_simpan']);
    Route::get('/dashboard/hasil', [DashboardController::class, 'list_hasil']);
    Route::get('/dashboard/hasil/{slug}', [DashboardController::class, 'hasil_materi']);
    Route::get('/dashboard/hasil/{slug}/export', [DashboardController::class, 'export']);
    Route::get('/dashboard/hasil/{u_id}/hapus', [DashboardController::class, 'hapus_jawaban']);
    Route::get('/dashboard/hasil/{slug}/{u_id}', [DashboardController::class, 'hasil_materi_detail']);


    Route::get('/dashboard/koleksi/tambah', [CollectionController::class, 'index']);
    Route::post('/dashboard/koleksi/tambah', [CollectionController::class, 'store']);
    Route::get('/dashboard/koleksi/{slug}/hapus', [CollectionController::class, 'delete']);
    Route::get('/dashboard/koleksi/{slug}', [CollectionController::class, 'detail']);
    Route::post('/dashboard/koleksi/{slug}', [CollectionController::class, 'update']);
});

Route::get('/learn/{code}', [LearnController::class, 'index'])->name('learn');
Route::post('/learn/{code}', [LearnController::class, 'create_session']);
Route::get('/learn/{code}/result', [LearnController::class, 'show_result']);
Route::get('/flush', [LearnController::class, 'flush_session']);
Route::get('/clear_session', [LearnController::class, 'clear_session']);
Route::get('/clear_history/{slug}', [LearnController::class, 'clear_history']);


Route::get('/play/{slug}', [PlayController::class, 'index']);
Route::post('/play/{slug}', [PlayController::class, 'create_session']);
Route::get('/play/{collection_slug}/restart', [PlayController::class, 'restart']);
Route::get('/play/{collection_slug}/{package_slug}', [PlayController::class, 'play']);
Route::get('/play/{collection_slug}/{package_slug}/save', [PlayController::class, 'save']);



Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminDashboardController::class, 'users']);
    Route::get('/user/{id}', [AdminDashboardController::class, 'edit_page']);
    Route::post('/user/{id}', [AdminDashboardController::class, 'save']);
    Route::get('/user/{id}/delete', [AdminDashboardController::class, 'delete']);
    Route::get('/topic', [AdminTopicController::class, 'index']);
    Route::get('/topic/{slug}', [AdminTopicController::class, 'edit_page']);
    Route::post('/topic/{slug}', [AdminTopicController::class, 'save']);
    Route::get('/topic/{slug}/delete', [AdminTopicController::class, 'delete']);
    Route::get('/report', [AdminReportController::class, 'index']);
    Route::get('/report/{id}/delete', [AdminReportController::class, 'delete']);
});


// api
Route::get('/api/get_soal/{package_id}', [LearnController::class, 'get_soal']);
Route::post('/api/submit-jawaban', [LearnController::class, 'submit_jawaban']);
Route::post('/api/submit-jawaban/quiz', [LearnController::class, 'submit_jawaban_quiz']);
Route::get('/api/get-saved-answer/{u_id}', [LearnController::class, 'get_saved']);


Route::post('/api/collection/submit-jawaban/{collection_slug}', [PlayController::class, 'submit_jawaban_api']);
Route::post('/api/collection/submit-jawaban-kuis/{collection_slug}', [PlayController::class, 'submit_jawaban_kuis_api']);
