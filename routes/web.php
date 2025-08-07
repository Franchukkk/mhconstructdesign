<?php

use App\Exports\ContactRequestsExport;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\Admin\ContactRequestController as AdminContactRequestController;
use App\Http\Controllers\SiteController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StaticPageController;
use App\Models\BlogPost;

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/export-contact-requests', function () {
    return Excel::download(new ContactRequestsExport, 'contact_requests.xlsx');
})->name('export.contact.requests');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::prefix('admin')->middleware(['web', 'auth'])->name('admin.')->group(function () {

    Route::get('projects', function () {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->index();
    })->name('projects.index');

    Route::get('requests', function () {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminContactRequestController::class)->index();;
    })->name('requests.index');

    Route::get('/', function () {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->index();
    })->name('projects.index');

    Route::get('projects/create', function () {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->create();
    })->name('projects.create');

    Route::post('projects', function (Request $request) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->store($request);
    })->name('projects.store');

    Route::get('projects/{project}/edit', function (Project $project) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->edit($project);
    })->name('projects.edit');

    Route::put('projects/{project}', function (Request $request, Project $project) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->update($request, $project);
    })->name('projects.update');

    Route::delete('projects/{project}', function (Project $project) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(ProjectController::class)->destroy($project);
    })->name('projects.destroy');
});

Route::prefix('admin')->middleware(['web', 'auth'])->name('admin.')->group(function () {
    Route::get('blog', [AdminBlogController::class, 'index'])->name('blog.index');
    Route::get('blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
    Route::post('blog', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::post('blog/upload', [AdminBlogController::class, 'uploadImage'])->name('blog.upload');
    Route::get('blog/{post}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::put('blog/{post}', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('blog/{post}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
    Route::post('blog/upload', [AdminBlogController::class, 'uploadImage'])->name('blog.upload');

});


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/privacy-policy', [StaticPageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-use', [StaticPageController::class, 'termsOfUse'])->name('terms.of.use');


// Показати форму запиту
Route::get('/contact-request', [ContactRequestController::class, 'index'])->name('contact-request.form');

// Обробка форми (POST)
Route::post('/contact-request', [ContactRequestController::class, 'store'])->name('contact-request.submit');
