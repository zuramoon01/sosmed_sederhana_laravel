<?php

use App\Models\Post;

use App\Models\Comment;
use App\Http\Middleware\Banned;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::get('/', fn () => view('index', [
    'posts' => Post::all(),
    'comments' => Comment::all(),
]))->middleware('auth');

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('signup', 'authFormPage');
        Route::post('signup', 'signupUser');

        Route::get('/login', 'authFormPage')->name('login');
        Route::post('/login', 'loginUser');
    });

    Route::get('/logout', 'logout')->middleware('auth');
});

// Route::get('/signup', [AuthController::class, 'authFormPage'])->middleware('guest');
// Route::post('/signup', [AuthController::class, 'signupUser'])->middleware('guest');

// Route::get('/login', [AuthController::class, 'authFormPage'])->middleware('guest')->name('login');
// Route::post('/login', [AuthController::class, 'loginUser'])->middleware('guest');

// Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::controller(PostController::class)->group(function () {
    Route::prefix('/post')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::post('/', 'createPost')->middleware(Banned::class);
            Route::get("/edit/{post:id}", 'editPostPage');
            Route::put('/edit/{post:id}', 'editPost');
            Route::get('/delete/{post:id}', 'deletePost');
        });
    });
});

// Route::post('/post', [PostController::class, 'createPost'])->middleware('auth');
// Route::get('/post/edit/{post:id}', [PostController::class, 'editPostPage'])->middleware('auth');
// Route::put('/post/edit/{post:id}', [PostController::class, 'editPost'])->middleware('auth');
// Route::get('/post/delete/{post:id}', [PostController::class, 'deletePost'])->middleware('auth');

Route::controller(CommentController::class)->group(function () {
    Route::prefix('/comment')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::post('/{post:id}', 'createComment')->middleware(Banned::class);
            Route::put('/edit/{comment:id}', 'editComment');
            Route::get('/delete/{comment:id}', 'deleteComment');
        });
    });
});

// Route::post('/comment/{post:id}', [CommentController::class, 'createComment']);
// Route::put('/comment/edit/{comment:id}', [CommentController::class, 'editComment']);
// Route::get('/comment/delete/{comment:id}', [CommentController::class, 'deleteComment']);

Route::get('/test', function () {
    return response()->json('ok');
});
