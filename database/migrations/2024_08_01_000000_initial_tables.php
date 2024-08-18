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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('address')->nullable();
            $table->text('experience')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('cover_letter')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('slogan')->nullable();
            $table->timestamps();
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('company_id');
            $table->string('type');
            $table->string('title');
            $table->string('level');
            $table->string('slug');
            $table->json('salary');
            $table->text('description');
            $table->integer('number_of_vacancy');
            $table->integer('experience');

            $table->text('roles');
            $table->integer('category_id');
            $table->string('position');
            $table->string('address');
            $table->integer('featured');
            $table->integer('status');
            $table->date('last_date');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('job_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');

        Schema::dropIfExists('categories');

        Schema::dropIfExists('offers');

        Schema::dropIfExists('companies');

        Schema::dropIfExists('profiles');
    }
};
