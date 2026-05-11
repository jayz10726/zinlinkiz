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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->string('customer_email')->nullable();
        $table->string('product_bought')->nullable();
        $table->string('location')->nullable();
        $table->tinyInteger('rating')->default(5); // 1-5
        $table->text('review_text');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->boolean('is_featured')->default(false);
        $table->string('initials', 3)->nullable();
        $table->string('avatar_color')->default('bg-blue-600');
        $table->timestamps();
    });
}
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
