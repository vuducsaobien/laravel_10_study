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
        Schema::create('table_1_4', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('table_1_id');
            $table->unsignedBigInteger('table_4_id');
            $table->timestamps();

            // Thêm foreign key constraints
            $table->foreign('table_1_id')
                  ->references('id')
                  ->on('table_1')
                  ->onDelete('cascade');
                  
            $table->foreign('table_4_id')
                  ->references('id')
                  ->on('table_4')
                  ->onDelete('cascade');

            // Thêm unique constraint để tránh duplicate relationships
            $table->unique(['table_1_id', 'table_4_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_1_4');
    }
}; 