<?php

use App\Models\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

// Buat login
Route::get('login', function () {
    return view('admin.login');
})->name('login.index');



// Index
Route::get('app', function () {
    return view('admin.app');
})->name('app.index');

Route::get('homeadmin', [HomeController::class, 'index'])->name('homeadmin.index');
Route::get('homeadmin/create', [HomeController::class, 'create'])->name('homeadmin.create');
Route::post('homeadmin/store', [HomeController::class, 'store'])->name('homeadmin.store');
Route::get('homeadmin/edit/{id}', [HomeController::class, 'edit'])->name('homeadmin.edit');  
Route::put('homeadmin/update/{id}', [HomeController::class, 'update'])->name('homeadmin.update');
Route::delete('homeadmin/destroy/{id}', [HomeController::class, 'destroy'])->name('homeadmin.destroy');


Route::resource('aboutadmin', AboutController::class);



// Isi
Route::get('/', function () {
    $homes = Home::orderBy('id', 'DESC')->limit(2)->get();
    return view('compro.index', compact('homes'));
})->name('home.index');

Route::get('about', function () {
    return view('compro.about');
})->name('about.index');

Route::get('courses', function () {
    return view('compro.courses');
})->name('courses.index');

Route::get('team', function () {
    return view('compro.team');
})->name('team.index');

Route::get('testimonial', function () {
    return view('compro.testimonial');
})->name('testimonial.index');

Route::get('404', function () {
    return view('compro.404');      
})->name('404.index');

Route::get('contact', function () {
    return view('compro.contact');
})->name('contact.index');

