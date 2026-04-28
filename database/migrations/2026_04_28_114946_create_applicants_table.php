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
        Schema::create('applicants', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->string('education');
        $table->date('birth_date')->nullable();
        $table->string('city');
        $table->string('position_applied');
        $table->string('current_position');
        $table->text('experience')->nullable();
        $table->boolean('etimad_knowledge')->default(false);
        $table->string('cv_path')->nullable();
        $table->string('portfolio_path')->nullable();
        $table->enum('status', ['new', 'reviewed', 'contacted'])->default('new');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
