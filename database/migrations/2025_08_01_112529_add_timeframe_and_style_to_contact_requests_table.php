<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            $table->text('timeframe_flexibility')->nullable()->after('project_details');
            $table->text('design_style_description')->nullable()->after('timeframe_flexibility');
        });
    }

    public function down(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            $table->dropColumn(['timeframe_flexibility', 'design_style_description']);
        });
    }
};
