<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('how_heard')->nullable();
            $table->json('services_selected')->nullable();
            $table->text('project_details')->nullable();
            $table->string('gclid')->nullable();
            $table->string('client_id')->nullable();
            $table->string('referrer')->nullable();
            $table->string('page_url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
