<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\HomePage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/login', LoginPage::class);
Route::get('/register', RegisterPage::class);
Route::get('/forgot', ForgotPasswordPage::class);
Route::get('/reset', ResetPasswordPage::class);

Route::get('/success', SuccessPage::class);
Route::get('/cancel', CancelPage::class);

 Route::middleware('auth')->group(function(){
    Route::get('/login', function (){
         auth()->login;
         return redirect('/admin');
     });
 });
 use App\Http\Controllers\CsvImportController;

 Route::post('/import-csv', [CsvImportController::class, 'import'])->name('import-csv');
