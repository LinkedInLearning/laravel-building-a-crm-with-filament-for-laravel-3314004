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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->string('role')->nullable();
            $table->text('linkedin')->nullable();
            $table->string('company_website')->nullable();
            $table->text('business_details')->nullable();
            $table->string('business_type')->nullable();
            $table->enum('company_size', ['small', 'mid', 'big'])->nullable();
            $table->enum('temperature', ['cold', 'warm', 'hot'])->nullable();
            $table->text('referrals')->nullable();
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
