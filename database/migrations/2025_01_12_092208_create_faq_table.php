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
        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->string('status')->default('pending'); // pending, answered
            $table->foreignId('user_id')->constrained(); // who asked the question
            $table->foreignId('answered_by')->nullable()->constrained('users'); // admin who answered
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};
