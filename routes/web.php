<?php

use App\Exports\ContactRequestsExport;
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
use App\Models\BlogPost;

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/export-contact-requests', function () {
    return Excel::download(new ContactRequestsExport, 'contact_requests.xlsx');
});

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

    Route::get('blog', function () {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminBlogController::class)->index();
    })->name('blog.index');

    Route::get('blog/create', function () {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminBlogController::class)->create();
    })->name('blog.create');

    Route::post('blog', function (Request $request) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminBlogController::class)->store($request);
    })->name('blog.store');

    Route::get('blog/{post}/edit', function (BlogPost $post) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminBlogController::class)->edit($post);
    })->name('blog.edit');

    Route::put('blog/{post}', function (Request $request, BlogPost $post) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminBlogController::class)->update($request, $post);
    })->name('blog.update');

    Route::delete('blog/{post}', function (BlogPost $post) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            abort(403, 'Access denied');
        }
        return app(AdminBlogController::class)->destroy($post);
    })->name('blog.destroy');

});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
