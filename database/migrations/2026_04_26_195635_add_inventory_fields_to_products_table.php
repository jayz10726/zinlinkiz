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
    Schema::table('products', function (Blueprint $table) {
        $table->integer('low_stock_threshold')->default(5)->after('stock');
        $table->string('sku')->nullable()->unique()->after('name');
        $table->string('supplier')->nullable()->after('brand');
        $table->decimal('cost_price', 10, 2)->nullable()->after('price');
    });
}
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['low_stock_threshold', 'sku', 'supplier', 'cost_price']);   
        });
    }
};
