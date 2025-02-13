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
            Schema::create('suppliers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });

            // 2. Đảm bảo có ít nhất một supplier trong bảng suppliers
            $firstRecord = DB::table('suppliers')->where('id', 1)->first();
            $supplierId = 1;
            if (!$firstRecord) {
                DB::table('suppliers')->insert(['id' => $supplierId, 'name' => 'supplier 1']);
            }

            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('supplier_id')->default(1)->notNull()->after('id'); // $supplierId
            });

            // 3. Sau khi cập nhật dữ liệu, thêm khóa ngoại
            Schema::table('users', function (Blueprint $table) {
                $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');
            });

            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('supplier_id')->nullable(false)->default(null)->change();
            });

            // 5. History
            Schema::create('history', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('restrict'); // Liên kết tới users
                $table->unique('user_id'); // Đảm bảo mỗi User chỉ có 1 bản ghi trong history
                $table->string('detail');
            });

        } catch (\Exception $e) {
            $this->down();
            // throw $e; // Ném lỗi ra ngoài để Laravel dừng migration
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa bảng history trước (nếu có ràng buộc users)
        Schema::dropIfExists('history');

        // Kiểm tra khóa ngoại tồn tại trước khi xóa
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'supplier_id')) {
            // Lấy danh sách các khóa ngoại trong bảng users
            $foreignKeys = DB::select('SHOW CREATE TABLE users');
            $foreignKeys = isset($foreignKeys[0]->{'Create Table'}) ? $foreignKeys[0]->{'Create Table'} : '';

            // Nếu khóa ngoại tồn tại, mới tiến hành xóa
            if (strpos($foreignKeys, 'users_supplier_id_foreign') !== false) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropForeign(['supplier_id']);
                });
            }

            // Xóa cột supplier_id nếu vẫn còn
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'supplier_id')) {
                    $table->dropColumn('supplier_id');
                }
            });
        }

        // Xóa bảng suppliers cuối cùng
        Schema::dropIfExists('suppliers');
    }
};
