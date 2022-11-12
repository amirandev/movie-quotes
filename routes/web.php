<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Admin\DirectorsAdmin;
use App\Http\Controllers\Admin\MoviesAdmin;
use App\Http\Controllers\Admin\QuotesAdmin;

Route::middleware(['DetectLang'])->group(function () {

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/quotes', [MainController::class, 'Quotes'])->name('quotes');
    Route::get('/movies', [MovieController::class, 'Movies'])->name('movies');
    Route::get('/directors', [MainController::class, 'Directors'])->name('directors');
    Route::get('/top-directors', [MainController::class, 'TopDirectors'])->name('top_directors');
    Route::get('/movies-by/{id}/{title}', [MovieController::class, 'MoviesBy'])->name('movies_by');
    Route::get('/movie/{id}/{title}', [MovieController::class, 'ViewMovie'])->name('view_movie');

    Route::prefix('data')->group(function () {
        Route::get('/quotes', [DataController::class, 'Quotes'])->name('quotes.json');
        Route::get('/movies', [DataController::class, 'Movies'])->name('movies.json');
        Route::get('/directors', [DataController::class, 'Directors'])->name('directors.json');
    });

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [AuthController::class, 'index'])->name('login');
        Route::post('login', [AuthController::class, 'postLogin']);
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::group([/* რეჟისორებთან დაკავშირებული როუტები */], function () {
            Route::get('/directors', [DirectorsAdmin::class, 'directors'])->name('admin.directors');
            Route::get('/directors.json', [DirectorsAdmin::class, 'directorsJson'])->name('admin.directors.json');
            Route::get('/director.json', [DirectorsAdmin::class, 'TheDirectorJson'])->name('admin.thedirector.json');
            Route::post('/softdelete_director', [DirectorsAdmin::class, 'SoftDeleteDirector'])->name('admin.soft_delete_director');
            Route::post('/directors/add', [DirectorsAdmin::class, 'StoreDirector'])->name('admin.add_director');
            Route::post('/directors/edit/{id}', [DirectorsAdmin::class, 'EditDirector'])->name('admin.edit_director');
        });

        Route::prefix('movies')->group(function () {
            Route::get('/', [MoviesAdmin::class, 'Movies'])->name('admin.movies');
            Route::get('/json', [MoviesAdmin::class, 'MoviesJson'])->name('admin.movies.json');
            Route::post('/add', [MoviesAdmin::class, 'AddMovie'])->name('admin.add_movie');
            Route::get('/themovie.json', [MoviesAdmin::class, 'TheMovieJson'])->name('admin.themovie.json');
            Route::post('/directors/edit/{id}', [MoviesAdmin::class, 'EditMovie'])->name('admin.edit_movie');
            Route::post('/softdelete', [MoviesAdmin::class, 'SoftDelete'])->name('admin.soft_delete_movie');
        });

        Route::prefix('quotes')->group(function () {
            Route::get('/', [QuotesAdmin::class, 'Quotes'])->name('admin.quotes');
            Route::post('/add', [QuotesAdmin::class, 'AddMovie'])->name('admin.add_movie');
            Route::get('/json', [QuotesAdmin::class, 'QuotesJson'])->name('admin.quotes.json');
            Route::get('/thequote.json', [QuotesAdmin::class, 'TheQuoteJson'])->name('admin.thequote.json');
            Route::post('/edit/{id}', [QuotesAdmin::class, 'EditQuote'])->name('admin.edit_quote');
            Route::post('/softdelete', [QuotesAdmin::class, 'SoftDelete'])->name('admin.soft_delete_quote');
        });
    });

});
