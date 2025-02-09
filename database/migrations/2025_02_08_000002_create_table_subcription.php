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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('end_at')->nullable(false);
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('plan_id')->constrained()->onDelete('restrict'); // Thêm khóa ngoại tới bảng plans
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
