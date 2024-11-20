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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('applicationStatus')->default('In review');
            $table->string('projectName');
            $table->string('description');
            $table->date('targetCompletionDate');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->integer('duration')->nullable();
            $table->string('type');
            $table->string('newPlatform')->nullable();
            $table->string('newRequirement')->nullable();
            $table->string('existDetail')->nullable();
            $table->string('existFeature')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('system_pic_id')->nullable()->constrained('users');
            $table->foreignId('lead_developer_id')->nullable()->constrained('users');
            //$table->foreignId('developer_id')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
