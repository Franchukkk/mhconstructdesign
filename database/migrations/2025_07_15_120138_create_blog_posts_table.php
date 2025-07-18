<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Заголовок
            $table->string('slug')->unique(); // URL типу /blog/my-article
            $table->string('image')->nullable(); // Обкладинка
            $table->string('preview_text')->nullable(); // Короткий анонс
            $table->text('body')->nullable(); // Основний текст статті

            // SEO (опційно)
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamps(); // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
