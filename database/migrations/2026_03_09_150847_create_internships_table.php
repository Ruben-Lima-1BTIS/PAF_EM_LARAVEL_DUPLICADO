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
    Schema::create('internships', function (Blueprint $table) {
        $table->id(); // AUTO_INCREMENT

        $table->unsignedBigInteger('company_id');

        $table->string('title', 200)->nullable();
        $table->date('start_date');
        $table->date('end_date');

        $table->integer('total_hours_required');
        $table->decimal('min_hours_day', 4, 1)->default(6);
        $table->integer('lunch_break_minutes')->default(60);

        $table->enum('status', ['active', 'completed'])->default('active');

        $table->timestamp('created_at')->useCurrent();

        // Indexes
        $table->index('company_id');
        $table->index(['start_date', 'end_date']);

        // Foreign key
        $table->foreign('company_id')
              ->references('id')->on('companies')
              ->restrictOnDelete();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('internships');
}

};
