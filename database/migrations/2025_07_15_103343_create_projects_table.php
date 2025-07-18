<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // для /portfolio/project-name
            $table->string('title'); // заголовок
            $table->text('description')->nullable(); // опис під головним фото

            // Hero Image
            $table->string('hero_image')->nullable(); // ліве зображення

            // Технічний блок:
            $table->string('area')->nullable(); // площа, напр. 110 m²
            $table->string('implementation_time')->nullable(); // реалізація
            $table->string('design_time')->nullable(); // розробка проекту
            $table->string('style')->nullable(); // стиль
            $table->string('location')->nullable(); // адрес

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};