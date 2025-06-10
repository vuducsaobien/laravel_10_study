<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_3', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('table_1_id')->nullable();
            $table->foreign('table_1_id')->references('id')->on('table_1')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_3');
    }
};
