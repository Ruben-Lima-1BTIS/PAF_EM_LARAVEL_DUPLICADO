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
        Schema::create('hours', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('internship_id');

            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->unsignedBigInteger('supervisor_reviewed_by')->nullable();
            $table->string('supervisor_comment', 1000)->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('reviewed_at')->nullable();

            $table->index(['student_id', 'date']);
            $table->index('internship_id', 'status');
            $table->index('date');

            $table->foreign('student_id')
                  ->references('id')->on('users')
                  ->cascadeOnDelete();

            $table->foreign('internship_id')
                  ->references('id')->on('internships')
                  ->restrictOnDelete();

            $table->foreign('supervisor_reviewed_by')
                    ->references('id')->on('users')
                    ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hours');
    }
};
