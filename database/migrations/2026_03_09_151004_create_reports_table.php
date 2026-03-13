<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id(); // AUTO_INCREMENT

        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('internship_id');

        $table->string('file_path', 500);
        $table->string('original_name', 255);

        $table->enum('status', ['pending', 'approved', 'rejected'])
              ->default('pending');

        $table->unsignedBigInteger('supervisor_reviewed_by')->nullable();
        $table->string('supervisor_comment', 1000)->nullable();

        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('reviewed_at')->nullable();

        // Indexes
        $table->index(['student_id', 'internship_id']);
        $table->index('status');

        // Foreign keys
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
        Schema::dropIfExists('reports');
    }
};
