<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('project_gallery_items', function (Blueprint $table) {
            $table->string('design_image')->nullable()->change();
            $table->string('real_image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('project_gallery_items', function (Blueprint $table) {
            $table->string('design_image')->nullable(false)->change();
            $table->string('real_image')->nullable(false)->change();
        });
    }

};
