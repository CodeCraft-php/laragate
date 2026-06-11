<?php

use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    // Route::get('messages', [MessagesController::class, 'index'])->name('messages');
    Route::view('devices', 'devices')->name('devices');
    Route::view('system', 'system')->name('system');
    Route::view('settings', 'settings')->name('settings');
    Route::view('webhooks', 'webhooks')->name('webhooks');
    Route::view('authentication', 'authentication.authentication')->name('authentication');
    Route::view('authentication/token', 'authentication.token')->middleware([
            'password.confirm',
        ])->name('token');
});

Route::prefix('messages')->middleware(['auth', 'verified'])->group(function () {
    Route::get('overview', [MessagesController::class, 'index'])->name('messages.overview');
    Route::get('incoming', [MessagesController::class, 'incoming'])->name('messages.incoming');
    Route::get('outgoing', [MessagesController::class, 'outgoing'])->name('messages.outgoing');
    Route::post('outgoing', [MessagesController::class, 'store'])->name('messages.outgoing');
});

require __DIR__.'/settings.php';
