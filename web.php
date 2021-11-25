<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoatController;
use App\Http\Controllers\HealthHistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalExaminationController;
use App\Http\Controllers\MotherBreedingController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\WeightUpdateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
        Route::get('admin/createGene',[AdminController::class, 'gene'])->name('admin.createGene');
        Route::post('admin/updateGene',[AdminController::class, 'geneUpdate'])->name('admin.updateGene');
        Route::delete('admin/destroyGene/{id}',[AdminController::class, 'destroyGene'])->name('admin.destroyGene');
    
        Route::get('admin/createDisease',[AdminController::class, 'disease'])->name('admin.createDisease');
        Route::post('admin/updateDisease',[AdminController::class, 'diseaseUpdate'])->name('admin.updateDisease');
        Route::delete('admin/destroyDisease/{id}',[AdminController::class, 'destroyDisease'])->name('admin.destroyDisease');
    
        Route::get('admin/createVaccine',[AdminController::class, 'vaccine'])->name('admin.createVaccine');
        Route::post('admin/updateVaccine',[AdminController::class, 'vaccineUpdate'])->name('admin.updateVaccine');
        Route::delete('admin/destroyVaccine/{id}',[AdminController::class, 'destroyVaccine'])->name('admin.destroyVaccine');    
        });

    Route::resource('goats',GoatController::class);
    Route::get('homeUpdateMultiple',[GoatController::class, 'homeUpdateMultiple'])->name('goats.updateMultipleHome');
    Route::get('search', [GoatController::class, 'search'])->name('goats.search');
    Route::delete('deleteall', [GoatController::class, 'deleteAll'])->name('goats.deleteall');

    Route::get('/goat/homeUpdate/{goatId}',[GoatController::class, 'homeUpdate'])->name('goats.updateHome');
    Route::get('/goat/showSelection/{goatId}',[GoatController::class, 'showSelection'])->name('goats.showSelection');

    Route::get('/goat/health/{goatId}',[GoatController::class, 'health'])->name('goats.health');
    Route::post('/goat/healthUpdate/{goatId}',[GoatController::class, 'healthUpdate'])->name('goats.healthUpdate');
    Route::get('/goat/indexHealth/{goat}',[GoatController::class, 'indexHealth'])->name('goats.indexHealth');
    Route::delete('/goat/destroyHealth/{health}',[GoatController::class, 'destroyHealth'])->name('goats.destroyHealth');

    Route::get('/goat/vaccination/{goatId}',[GoatController::class, 'vaccination'])->name('goats.vaccination');
    Route::post('/goat/vaccineUpdate/{goatId}',[GoatController::class, 'vaccineUpdate'])->name('goats.vaccineUpdate');
    Route::get('/goat/indexVaccine/{goat}',[GoatController::class, 'indexVaccine'])->name('goats.indexVaccine');
    Route::delete('/goat/destroyVaccine/{vaccine}',[GoatController::class, 'destroyVaccine'])->name('goats.destroyVaccine');

    Route::get('/goat/weight/{goatId}',[GoatController::class, 'weight'])->name('goats.weight');
    Route::post('/goat/updateWeight/{goatId}',[GoatController::class, 'updateWeight'])->name('goats.weightUpdate');
    Route::get('/goat/indexWeight/{goat}',[GoatController::class, 'indexWeight'])->name('goats.indexWeight');
    Route::delete('/goat/destroyWeight/{weight}',[GoatController::class, 'destroyWeight'])->name('goats.destroyWeight');

    Route::get('/goat/medical/{goatId}',[GoatController::class, 'medical'])->name('goats.medical');
    Route::post('/goat/medicalUpdate/{goatId}',[GoatController::class, 'medicalUpdate'])->name('goats.medicalUpdate');
    Route::get('/goat/indexMedical/{goat}',[GoatController::class, 'indexMedical'])->name('goats.indexMedical');
    Route::delete('/goat/destroyMedical/{medical}',[GoatController::class, 'destroyMedical'])->name('goats.destroyMedical');

    Route::get('/goat/breed/{goatId}',[GoatController::class, 'breed'])->name('goats.breed');
    Route::post('/goat/updateBreed/{goatId}',[GoatController::class, 'updateBreed'])->name('goats.breedUpdate');
    Route::get('/goat/indexBreed/{goat}',[GoatController::class, 'indexBreed'])->name('goats.indexBreed');
    Route::delete('/goat/destroyBreed/{breed}',[GoatController::class, 'destroyBreed'])->name('goats.destroyBreed');

    Route::get('/goat/{goatId}/qrcode', [GoatController::class, 'generate'])->name('generate');

    Route::get('breed',[MotherBreedingController::class, 'breed'])->name('goats.multiBreed');
    Route::post('updateBreed',[MotherBreedingController::class, 'updateBreed'])->name('goats.multiBreedUpdate');

    Route::get('weight',[WeightUpdateController::class, 'weight'])->name('goats.multiWeight');
    Route::post('updateWeight',[WeightUpdateController::class, 'updateWeight'])->name('goats.multiWeightUpdate');

    Route::get('health',[HealthHistoryController::class, 'health'])->name('goats.multiHealth');
    Route::post('healthUpdate',[HealthHistoryController::class, 'healthUpdate'])->name('goats.multiHealthUpdate');

    Route::get('medical',[MedicalExaminationController::class, 'medical'])->name('goats.multiMedical');
    Route::post('medicalUpdate',[MedicalExaminationController::class, 'medicalUpdate'])->name('goats.multiMedicalUpdate');

    Route::get('vaccination',[VaccinationController::class, 'vaccination'])->name('goats.multiVaccination');
    Route::post('vaccineUpdate',[VaccinationController::class, 'vaccineUpdate'])->name('goats.multiVaccineUpdate');


    Route::group(['middleware' => 'web'], function () {

        Route::get('/edit-profile', [UserController::class, 'editprofile']);
        
        Route::post('/edit-profile', [UserController::class, 'saveeditprofile']);

        Route::post('change-password', [UserController::class, 'store'])->name('change.password');
        
        });

});