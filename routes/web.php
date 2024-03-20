<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/login', function () {
    return view('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', [IdeaController::class, 'feed'])->name('feed');
    Route::get('/feed', [IdeaController::class, 'feed']);
    Route::post('/timeline', [IdeaController::class, 'store'])->name('postIdea');
    Route::get('/comment/{idea_id}', [IdeaController::class, 'show'])->name('show_comment');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment');
    Route::post('/like', [LikeController::class, 'store'])->name('like');
    Route::get('/ideas/{idea}/comments', [IdeaController::class, 'loadComments']);

    Route::get('timeline/', [IdeaController::class, 'myTimeline'])->name('my_timeline');
    Route::get('timeline/{username}', [IdeaController::class, 'timeline'])->name('timeline');




    Route::post('/follow/', [FollowController::class, 'store'])->name('follow');
    Route::delete('/follow/', [FollowController::class, 'destroy'])->name('unfollow');

    Route::get('/explore/', [FollowController::class, 'explore'])->name('explore');
    Route::post('/explore/', [FollowController::class, 'storeRedirect'])->name('follow.redirect');

    // Route::get('/profile/{username}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/{username}', [ProfileController::class, 'update'])->name('profile.updtae');


});




require __DIR__.'/auth.php';
