<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\JobVacancyController;
use App\Http\Controllers\Hrd\ApplicantController;
use App\Http\Controllers\Hrd\DashboardController;
use App\Http\Controllers\Hrd\JobApplicationController;
use App\Http\Controllers\Hrd\ReportController;
use App\Http\Controllers\Hrd\SelectionController;
use App\Http\Controllers\Hrd\VacancyController as HrdVacancyController;

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

// ==================== LOGIN & LOGOUT (UC-10) ====================
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::redirect('admin/login', '/login'); // URL lama

// ==================== ADMIN: Kelola Lowongan (UC-11) ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn () => redirect()->route('admin.vacancies.index'))->name('dashboard');

    Route::patch('lowongan/{vacancy}/toggle', [JobVacancyController::class, 'toggle'])->name('vacancies.toggle');
    Route::resource('lowongan', JobVacancyController::class)
        ->parameters(['lowongan' => 'vacancy'])
        ->names('vacancies')
        ->except('show');
});

// ==================== HRD (UC-12 s/d UC-15) ====================
Route::middleware(['auth', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {

    // ---------- Dashboard ----------
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ---------- UC-12 Daftar Lowongan (hanya lihat) ----------
    Route::get('lowongan', [HrdVacancyController::class, 'index'])->name('vacancies.index');

    // ---------- UC-13A: Lamaran Masuk (hanya pelamar status 'baru') ----------
    // Route ini diproses oleh ApplicantController@index → mode 'masuk'
    Route::get('lamaran', [ApplicantController::class, 'index'])
        ->name('applications.index');

    // ---------- UC-13B: Manajemen Pelamar (proses seleksi + filter) ----------
    // Route ini diproses oleh ApplicantController@index → mode 'manajemen'
    Route::get('pelamar', [ApplicantController::class, 'index'])
        ->name('applicants.index');

    // ---------- Aksi terhadap pelamar (dipakai di kedua halaman) ----------
    Route::patch('lamaran/{application}', [JobApplicationController::class, 'update'])
        ->name('applications.update');
    Route::get('lamaran/{application}/cv', [JobApplicationController::class, 'cv'])
        ->name('applications.cv');
    Route::delete('lamaran/{application}', [JobApplicationController::class, 'destroy'])
        ->name('applications.destroy');

    // ---------- UC-13C: Terima Pelamar + Kirim Email Pengumuman ----------
    // Khusus pelamar di Tahap Final (status = 'wawancara')
    // Mengirim email otomatis via ApplicantAcceptedMail
    Route::post(
        'applicants/{application}/accept-notify',
        [ApplicantController::class, 'acceptAndNotify']
    )->name('applicants.accept-notify');

    // ---------- UC-14 Proses Seleksi (Lanjut Final / Terima / Gugur) ----------
    Route::get('seleksi', [SelectionController::class, 'index'])->name('selection.index');
    Route::post('seleksi/{application}', [SelectionController::class, 'decide'])->name('selection.decide');

    // ---------- UC-15 Rekap & Laporan ----------
    Route::get('laporan', [ReportController::class, 'index'])->name('report.index');
    Route::get('laporan/export', [ReportController::class, 'export'])->name('report.export');
    Route::get('laporan/arsip/{file}', [ReportController::class, 'download'])->name('report.download');
    Route::delete('laporan/arsip/{file}', [ReportController::class, 'destroy'])->name('report.destroy');
});