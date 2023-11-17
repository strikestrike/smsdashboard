<?php

use App\Http\Controllers\BlackListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\SendingServerController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user',UserController::class);

    Route::delete('leads/destroy', [LeadController::class, 'massDestroy'])->name('leads.massDestroy');
    Route::post('campaigns/assignTags', [LeadController::class, 'assignTags'])->name('leads.assignTags');
    Route::post('campaigns/assignExclusions', [LeadController::class, 'assignExclusions'])->name('leads.assignExclusions');
    Route::resource('leads', LeadController::class);

    Route::delete('campaigns/destroy', [CampaignController::class, 'massDestroy'])->name('campaigns.massDestroy');
    Route::resource('campaigns', CampaignController::class);

    Route::delete('sendingservers/destroy', [SendingServerController::class, 'massDestroy'])->name('sendingservers.massDestroy');
    Route::resource('sendingservers', SendingServerController::class);

    Route::delete('blacklist/destroy', [BlackListController::class, 'massDestroy'])->name('blacklist.massDestroy');
    Route::resource('blacklist', BlackListController::class);

    Route::get('feeds',[ImportController::class,'index'])->name('feeds.index');
    Route::post('feeds/postUploadExcel',[ImportController::class,'postUploadExcel'])->name('feeds.upload');
});
