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
            $table->string('slug')->unique(); // URL-слаг

            $table->string('image')->nullable(); // Обкладинка
            $table->text('body')->nullable(); // Основний текст (HTML)

            // SEO
            $table->string('meta_title')->nullable(); // <= 60 символів
            $table->string('meta_description')->nullable(); // <= 160 символів

            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
