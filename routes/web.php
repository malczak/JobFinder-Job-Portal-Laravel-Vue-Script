<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployerRegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth routes
 Auth::routes(['verify' => true]);

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Home Routes
Route::get('/', [OfferController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/jobs/create', [OfferController::class, 'create'])->name('job.create');
Route::post('/jobs/create', [OfferController::class, 'store'])->name('job.store');
Route::get('/job/{id}/edit', [OfferController::class, 'edit'])->name('job.edit');
Route::post('/job/{id}/edit', [OfferController::class, 'update'])->name('job.update');
Route::post('/job/{id}/delete', [OfferController::class, 'deleteJob'])->name('job.delete');
Route::get('/jobs/myjobs', [OfferController::class, 'myjob'])->name('myjobs');
Route::get('/jobs/alljobs', [OfferController::class, 'allJobs'])->name('alljobs');
Route::get('/jobs/applications', [OfferController::class, 'applicant'])->name('applicant');
Route::get('/job/{id}/{job}', [OfferController::class, 'show'])->name('job.show');
Route::get('/jobs/toggle/{id}', [OfferController::class, 'jobToggle'])->name('job.toggle');

// user profile
Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile')->middleware('seeker');
Route::post('/user/profile/create', [UserProfileController::class, 'store'])->name('profile.create')->middleware('seeker');
Route::post('/user/coverletter', [UserProfileController::class, 'coverletter'])->name('cover.letter')->middleware('seeker');
Route::post('/user/resume', [UserProfileController::class, 'resume'])->name('resume')->middleware('seeker');
Route::post('/user/avatar', [UserProfileController::class, 'avatar'])->name('avatar')->middleware('seeker');

// Company
Route::get('/company/{id}/{company}', [CompanyController::class, 'index'])->name('company.index');
Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/company/create', [CompanyController::class, 'store'])->name('company.store');
Route::post('/company/logo', [CompanyController::class, 'logo'])->name('logo');
Route::post('/company/banner', [CompanyController::class, 'banner'])->name('banner');
// Employer
Route::view('employer/register', 'auth.employer-register')->name('employer.register');
Route::post('employer/register', [EmployerRegisterController::class, 'employerRegister'])->name('empl.register');

// Applicant
Route::post('/applications/{id}', [OfferController::class, 'apply'])->name('apply');

// Save job or unsave job
Route::post('/save/{id}', [FavoriteController::class, 'saveJob']);
Route::post('/unsave/{id}', [FavoriteController::class, 'unSaveJob']);

// Search route
Route::get('/jobs/search', [OfferController::class, 'searchJobs']);

// Category route
Route::get('/category/{id}/{slug}', [CategoryController::class, 'index'])->name('category.index');

// Company route
Route::get('/companies', [CompanyController::class, 'company'])->name('company');

// Email Route
Route::post('/job/mail', [EmailController::class, 'send'])->name('mail');


