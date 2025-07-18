<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');

            $table->string('design_image'); // рендер
            $table->string('real_image');   // реальне фото

            $table->text('description')->nullable(); // короткий опис під парою

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_gallery_items');
    }
};
