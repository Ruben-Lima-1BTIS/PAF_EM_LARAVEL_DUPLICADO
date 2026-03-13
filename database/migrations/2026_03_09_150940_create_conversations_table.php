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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('supervisor_id');

            $table->timestamp('created_at')->useCurrent();

            $table->unique(['student_id', 'supervisor_id']);

            $table->foreign('student_id')
                  ->references('id')->on('users')
                  ->cascadeOnDelete();

            $table->foreign('supervisor_id')
                    ->references('id')->on('users')
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
};
