<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Common;

Route::get('/', [Home::class, 'index']);


Route::get(ADMINPATH . 'login', [Authentication::class, 'index']);
Route::post(ADMINPATH . 'checkLogin', [Authentication::class, 'checkLogin']);
Route::get(ADMINPATH . 'logout', [Authentication::class, 'logout']);

Route::middleware(['authguard','guest'])->group(function () {
    Route::get(ADMINPATH . 'dashboard', [Dashboard::class, 'index']);
    Route::get(ADMINPATH . 'websetting', [Websetting::class, 'index']);
    Route::post(ADMINPATH . 'save-websetting', [Websetting::class, 'save_websetting']);
    //Ajax Routes
    Route::match(["get", "post"], ADMINPATH."getSlug", [Ajax::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."changeStatus", [Ajax::class, 'changeStatus']);
    //CMS Master
    Route::match(["get", "post"], ADMINPATH."cms-list", [Cms::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."add-cms", [Cms::class, 'add_cms']);
    Route::match(["get", "post"], ADMINPATH."save-cms", [Cms::class, 'save_cms']);
    Route::match(["get", "post"], ADMINPATH."cms-data", [Cms::class, 'getRecords']);
    //Skills Master 
    Route::match(["get", "post"], ADMINPATH."skill-list", [Skills::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."add-skill", [Skills::class, 'add_skill']);
    Route::match(["get", "post"], ADMINPATH."save-skill", [Skills::class, 'save_skill']);
    Route::match(["get", "post"], ADMINPATH."skill-data", [Skills::class, 'getRecords']);
    //Experience Master 
    Route::match(["get", "post"], ADMINPATH."experience-list", [Experience::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."add-experience", [Experience::class, 'add_experience']);
    Route::match(["get", "post"], ADMINPATH."save-experience", [Experience::class, 'save_experience']);
    Route::match(["get", "post"], ADMINPATH."experience-data", [Experience::class, 'getRecords']);
    //Education Master 
    Route::match(["get", "post"], ADMINPATH."education-list", [Education::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."add-education", [Education::class, 'add_education']);
    Route::match(["get", "post"], ADMINPATH."save-education", [Education::class, 'save_education']);
    Route::match(["get", "post"], ADMINPATH."education-data", [Education::class, 'getRecords']); 
    //Portfolio Master 
    Route::match(["get", "post"], ADMINPATH."portfolio-list", [Portfolio::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."add-portfolio", [Portfolio::class, 'add_portfolio']);
    Route::match(["get", "post"], ADMINPATH."save-portfolio", [Portfolio::class, 'save_portfolio']);
    Route::match(["get", "post"], ADMINPATH."portfolio-data", [Portfolio::class, 'getRecords']);
    //Query List 
    Route::match(["get", "post"], ADMINPATH."query-list", [Query::class, 'index']);
    Route::match(["get", "post"], ADMINPATH."query-data", [Query::class, 'getRecords']);
});

Route::post('getRandomCaptcha', [Home::class, 'getRandomCaptcha']);
Route::post('save-query', [Home::class, 'saveQuery']);
Route::get('/{any}', [Common::class, 'index'])->where('any', '.*');

