<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\LuckyController;
use App\Http\Controllers\Client\RegisterController;
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

Route::get('/', function () {
    return redirect()->route('admin.campaigns.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('handleLogout');

Route::prefix('admin')->middleware(['auth'])->group(function (): void {
    Route::get('/', fn () => redirect()->route('admin.campaigns.index'));
    Route::get('/dashboard', fn () => view('pages.dashboard'))->name('admin.dashboard');
    Route::prefix('campaigns')->group(function (): void {
        Route::get('/', [CampaignController::class, 'index'])->name('admin.campaigns.index');
        Route::get('/create', [CampaignController::class, 'create'])->name('admin.campaigns.create');
        Route::get('/{id}/edit', [CampaignController::class, 'edit'])->name('admin.campaigns.edit');

    });

    Route::prefix('users')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');

    });

    Route::get('coming-soon', fn () => view('coming-soon'))->name('admin.coming-soon');
});

Route::get('/lucky/{campaign_id}', [LuckyController::class, 'index'])->name('lucky.number');
Route::get('/lucky/{campaign_id}/auth', [LuckyController::class, 'auth'])->name('lucky.auth');
Route::post('/lucky/{campaign_id}/auth', [LuckyController::class, 'handleCheckKey'])->name('lucky.handleCheckKey');
Route::get('/lucky/{campaign_id}/register', [RegisterController::class, 'index'])->name('lucky.register');
