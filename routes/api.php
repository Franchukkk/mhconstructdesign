<?php

use App\Http\Controllers\Api\ContactRequestController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\BlogPostController;

Route::post('/contact', [ContactRequestController::class, 'store']);

Route::apiResource('projects', ProjectController::class);

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogPostController::class, 'index']);         // GET /api/blog
    Route::get('/{slug}', [BlogPostController::class, 'show']);    // GET /api/blog/my-article
    Route::post('/', [BlogPostController::class, 'store']);        // POST /api/blog
    Route::put('/{id}', [BlogPostController::class, 'update']);    // PUT /api/blog/5
    Route::delete('/{id}', [BlogPostController::class, 'destroy']); // DELETE /api/blog/5
});
