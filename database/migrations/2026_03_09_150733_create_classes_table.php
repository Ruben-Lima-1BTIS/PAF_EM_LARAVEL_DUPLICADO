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
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->string('course', 150); 
        $table->string('sigla', 50);
        $table->integer('year')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->unique(['sigla', 'year']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('classes');
}

};
