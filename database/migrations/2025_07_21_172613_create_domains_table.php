<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('domain')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('ssl_enabled')->default(false);
            $table->string('ssl_certificate_path')->nullable();
            $table->string('ssl_key_path')->nullable();
            $table->json('custom_headers')->nullable();
            $table->integer('timeout')->default(30);
            $table->boolean('enable_logging')->default(true);
            $table->timestamps();
            
            $table->index(['user_id', 'is_active']);
            $table->index('domain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
