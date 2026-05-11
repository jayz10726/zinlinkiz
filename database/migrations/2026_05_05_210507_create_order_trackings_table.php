<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        // Add user_id to orders if it doesn't exist
        if (!Schema::hasColumn('orders', 'user_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->foreignId('user_id')
                      ->nullable()
                      ->after('id')
                      ->constrained()
                      ->onDelete('set null');
            });
        }
 
        // Create order_trackings table
        if (!Schema::hasTable('order_trackings')) {
            Schema::create('order_trackings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')
                      ->constrained()
                      ->onDelete('cascade');
                $table->string('status');
                $table->text('note')->nullable();
                $table->string('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }
 
    public function down(): void
    {
        Schema::dropIfExists('order_trackings');
 
        if (Schema::hasColumn('orders', 'user_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};