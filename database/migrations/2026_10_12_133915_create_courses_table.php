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
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();

        $table->foreignId('instructor_id')
            ->constrained('instructors')
            ->restrictOnDelete();

        $table->foreignId('instrument_id')
            ->nullable()
            ->constrained('instruments')
            ->nullOnDelete();

        $table->decimal('fee', 10, 2)->default(0);
        $table->unsignedSmallInteger('duration_weeks')->default(4);
        $table->string('status')->default('Active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
