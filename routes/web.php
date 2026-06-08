<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/donasi', [HomeController::class, 'donasi'])->name('donasi');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::get('/campaign/{campaign}/donation', [CampaignController::class, 'donation'])->name('campaign.donation');
Route::post('/campaign/{campaign}/donation', [CampaignController::class, 'storeDonation'])->name('campaign.donation.store');
Route::resource('campaign', CampaignController::class)->except(['show']);
