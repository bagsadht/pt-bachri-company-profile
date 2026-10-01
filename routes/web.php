<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobVacancyController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Middleware\EnsureAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes - PT Bachri Samudera Indonesia
|--------------------------------------------------------------------------
*/

// ==================== BERANDA ====================
Route::get('/', [CompanyController::class, 'home'])->name('home');

// ==================== TENTANG KAMI ====================
Route::get('/about', [CompanyController::class, 'about'])->name('about');

// ==================== LAYANAN ====================
Route::get('/services', [CompanyController::class, 'services'])->name('services');

// ==================== KONTAK ====================
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==================== COMPANY PROFILE ====================
Route::get('/company-profile', [CompanyController::class, 'companyProfile'])->name('company-profile');

// ==================== KARIR / LOWONGAN PEKERJAAN ====================
Route::get('/karir', [CareerController::class, 'index'])->name('careers.index');
Route::get('/karir/{vacancy:slug}', [CareerController::class, 'show'])->name('careers.show');
Route::post('/karir/{vacancy:slug}/lamar', [CareerController::class, 'apply'])
    ->middleware('throttle:5,1')
    ->name('careers.apply');

// ==================== ADMIN ====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');

    Route::middleware(EnsureAdmin::class)->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::patch('lowongan/{vacancy}/toggle', [JobVacancyController::class, 'toggle'])->name('vacancies.toggle');

        Route::resource('lowongan', JobVacancyController::class)
            ->parameters(['lowongan' => 'vacancy'])
            ->names('vacancies')
            ->except('show');

        Route::get('lamaran', [JobApplicationController::class, 'index'])->name('applications.index');
        Route::patch('lamaran/{application}', [JobApplicationController::class, 'update'])->name('applications.update');
        Route::get('lamaran/{application}/cv', [JobApplicationController::class, 'cv'])->name('applications.cv');
        Route::delete('lamaran/{application}', [JobApplicationController::class, 'destroy'])->name('applications.destroy');
    });
});