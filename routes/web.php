<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ClassApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\ClassPageController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\InstructorPageController;
use App\Models\Review;
use App\Support\SiteImage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $classes = App\Models\ArcheryClass::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get()
        ->map(fn (App\Models\ArcheryClass $class) => ClassPageController::formatClassCard($class));

    $carouselReviews = Review::carouselQuery()->get();

    $homepageHeroImages = SiteImage::homepageHeroImages();

    $instructors = [
        [
            'first_name' => 'Riley',
            'last_name' => 'Hart',
            'quote' => 'Great archery is built from control, focus, and small improvements made every session.',
            'image_url' => SiteImage::instructorImage('ins_1'),
        ],
        [
            'first_name' => 'Alex',
            'last_name' => 'Wong',
            'quote' => 'Your greatest advantage is how prepared you feel before you draw the bow.',
            'image_url' => SiteImage::instructorImage('ins_2'),
        ],
        [
            'first_name' => 'Maya',
            'last_name' => 'Chen',
            'quote' => 'Archery should feel empowering and exciting from day one.',
            'image_url' => SiteImage::instructorImage('ins_3'),
        ],
    ];

    return view('welcome', [
        'classes' => $classes,
        'carouselReviews' => $carouselReviews,
        'homepageHeroImages' => $homepageHeroImages,
        'instructors' => $instructors,
        'activePage' => 'home',
    ]);
});

Route::get('/classes', [ClassPageController::class, 'index'])->name('classes');
Route::get('/instructors', [InstructorPageController::class, 'index'])->name('instructors');
Route::get('/about', [AboutPageController::class, 'index'])->name('about');
Route::get('/contact', [ContactPageController::class, 'index'])->name('contact');

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/signup', [AuthController::class, 'signup']);
Route::post('/api/logout', [AuthController::class, 'logout']);
Route::get('/api/user', [AuthController::class, 'user']);

Route::get('/api/classes/{archeryClass}', [ClassApiController::class, 'show']);
Route::get('/api/bookings', [BookingController::class, 'index']);
Route::post('/api/bookings', [BookingController::class, 'store'])->middleware('auth');
Route::post('/api/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->middleware('auth');

Route::post('/api/contact', [ContactController::class, 'store']);
Route::post('/api/reviews', [ReviewController::class, 'store']);
