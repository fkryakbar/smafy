<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminTopicController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectionResultController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SublessonController;
use App\Models\Sublesson;
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
Route::group(['middleware' => 'auth.user', 'prefix' => 'dashboard'], function () {

    Route::get('', [DashboardController::class, 'index']);
    Route::get('/lessons', [LessonController::class, 'index']);
    Route::post('/lessons', [LessonController::class, 'create']);
    Route::get('/lessons/{slug}/hapus', [LessonController::class, 'delete']);
    Route::get('/lessons/{slug}', [SublessonController::class, 'index']);
    Route::post('/lessons/{slug}', [SublessonController::class, 'create']);
    Route::get('/lessons/{slug}/{sublesson_slug}', [SlideController::class, 'index']);
    Route::get('/lessons/{slug}/{sublesson_slug}/insert', [SlideController::class, 'insert']);
    Route::post('/lessons/{slug}/{sublesson_slug}/insert', [SlideController::class, 'create']);
    Route::post('/lessons/{slug}/{sublesson_slug}/settings', [SublessonController::class, 'update']);
    Route::get('/lessons/{slug}/{sublesson_slug}/{slide_id}/hapus', [SlideController::class, 'delete']);
    Route::get('/lessons/{slug}/{sublesson_slug}/{slide_id}/edit', [SlideController::class, 'edit']);
    Route::post('/lessons/{slug}/{sublesson_slug}/{slide_id}/edit', [SlideController::class, 'update']);
    Route::get('/lessons/{slug}/{sublesson_slug}/hapus', [SublessonController::class, 'delete']);
    Route::post('/lessons/{slug}/settings', [LessonController::class, 'update']);

    Route::get('/result', [ResultController::class, 'index']);

    Route::get('/lesson/{slug}/input', [LessonController::class, 'input_materi_package']);
    Route::post('/lesson/{slug}/input', [LessonController::class, 'post_input_materi_package']);
    Route::get('/lesson/{slug}/{id}/hapus', [LessonController::class, 'slide_hapus']);
    Route::get('/lesson/{slug}/{id}/edit', [LessonController::class, 'slide_edit']);
    Route::post('/lesson/{slug}/{id}/edit', [LessonController::class, 'slide_edit_simpan']);
    Route::get('/hasil/{slug}', [DashboardController::class, 'hasil_materi']);
    Route::get('/hasil/{slug}/export', [DashboardController::class, 'export']);
    Route::get('/hasil/{u_id}/hapus', [DashboardController::class, 'hapus_jawaban']);
    Route::get('/hasil/{slug}/{u_id}', [DashboardController::class, 'hasil_materi_detail']);
});



Route::get('/play/{slug}', [PlayController::class, 'index']);
Route::post('/play/{slug}', [PlayController::class, 'create_session']);
Route::get('/play/{collection_slug}/restart', [PlayController::class, 'restart']);
Route::get('/play/{slug}/{sublesson_slug}', [PlayController::class, 'play']);
Route::get('/play/{slug}/{sublesson_slug}/save', [PlayController::class, 'save']);


// api
Route::get('/api/get_soal/{package_id}', [LearnController::class, 'get_soal']);
Route::post('/api/submit-jawaban', [PlayController::class, 'api_save_answer']);
Route::post('/api/submit-jawaban-kuis', [PlayController::class, 'api_save_answer_kuis']);
Route::post('/api/submit-file', [PlayController::class, 'api_save_file']);
Route::get('/api/get-saved-answer/{participant_id}/{sublesson_slug}', [PlayController::class, 'api_get_saved_answer']);
