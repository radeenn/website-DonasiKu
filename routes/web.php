<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DocumentationFileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/donasi', [HomeController::class, 'donasi'])->name('donasi');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::get('/documentations', [DocumentationFileController::class, 'index'])->name('documentations.index');
Route::post('/documentations', [DocumentationFileController::class, 'store'])->name('documentations.store');
Route::delete('/documentations/{documentation}', [DocumentationFileController::class, 'destroy'])->name('documentations.destroy');

Route::get('/campaign/{campaign}/donation', [CampaignController::class, 'donation'])->name('campaign.donation');
Route::post('/campaign/{campaign}/donation', [CampaignController::class, 'storeDonation'])->name('campaign.donation.store');
Route::resource('campaign', CampaignController::class)->except(['show']);
