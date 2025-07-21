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
        Schema::create('routing_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('path_pattern');
            $table->string('target_url');
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD', 'OPTIONS', '*'])->default('*');
            $table->integer('priority')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('conditions')->nullable();
            $table->json('headers')->nullable();
            $table->enum('load_balancing', ['round_robin', 'least_connections', 'ip_hash'])->default('round_robin');
            $table->boolean('preserve_host')->default(false);
            $table->integer('timeout')->nullable();
            $table->timestamps();
            
            $table->index(['domain_id', 'is_active', 'priority']);
            $table->index('path_pattern');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routing_rules');
    }
};
