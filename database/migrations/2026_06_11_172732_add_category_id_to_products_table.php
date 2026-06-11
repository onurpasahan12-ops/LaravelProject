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
        // SchemaTable yerine doğrusu olan Blueprint yazıldı
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // SchemaTable yerine doğrusu olan Blueprint yazıldı
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['products_category_id_foreign']); // Garanti olması için foreign adını tam yazdık
            $table->dropColumn('category_id');
        });
    }
};
