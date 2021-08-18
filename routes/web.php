<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
Route::get('/category', [MainController::class, 'category'])->name('category');
Route::get('/question', [MainController::class, 'question'])->name('question');
Route::get('/user', [MainController::class, 'user'])->name('user');
Route::get('/content', [MainController::class, 'content'])->name('content');
Route::get('/quiz', [MainController::class, 'quiz'])->name('quiz');

Route::post('/add-category', [MainController::class, 'addCategory'])->name('add-category');
Route::post('/delete-category', [MainController::class, 'deleteCategory'])->name('delete-category');

Route::post('/question-manage', [MainController::class, 'questionManage'])->name('question-manage');
Route::post('/delete-question', [MainController::class, 'deleteQuestion'])->name('delete-question');

Route::post('/add-content', [MainController::class, 'addContent'])->name('add-content');

Route::post('/add-quiz', [MainController::class, 'addQuiz'])->name('add-quiz');

require __DIR__ . '/auth.php';
