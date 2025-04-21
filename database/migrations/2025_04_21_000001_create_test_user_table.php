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
        try {
            Schema::create('test_users', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable(false);
                $table->string('email')->nullable(false);
            });
        } catch (\Exception $e) {
            // $this->down();
            // throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_users');
    }
};
