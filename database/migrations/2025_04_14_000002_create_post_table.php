<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->unsignedBigInteger('author_id')->nullable()->default(null);
                $table->timestamps();
                $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('posts');
    }
};
