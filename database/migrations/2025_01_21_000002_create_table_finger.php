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
        Schema::create('fingers', function (Blueprint $table) {
            $table->id();
            $table->string('detail');

            $table->unsignedBigInteger('user_id')->unique(); // Đảm bảo chỉ có 1 finger (Vân tay) cho mỗi user

            // $table->unsignedBigInteger('user_id')->nullable(true); // onDelete('set null')
        
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            // ->onDelete('restrict');
            // ->onDelete('set null');
            // ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fingers');
    }
};
