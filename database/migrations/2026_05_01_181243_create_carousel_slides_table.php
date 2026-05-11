<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image');                          // stored path
            $table->string('badge_text')->nullable();         // e.g. "🔥 New Arrivals"
            $table->string('badge_color')->default('bg-blue-500/20 text-blue-300 border-blue-400/40');
            $table->string('btn_primary_text')->default('Shop Now →');
            $table->string('btn_primary_url')->default('/products');
            $table->string('btn_primary_color')->default('bg-blue-600 hover:bg-blue-500');
            $table->string('btn_secondary_text')->nullable();
            $table->string('btn_secondary_url')->nullable();
            $table->string('overlay_color')->default('rgba(10,15,40,0.88)'); // dark overlay
            $table->string('stat_1_value')->nullable();       // e.g. "KES 245K"
            $table->string('stat_1_label')->nullable();       // e.g. "Starting from"
            $table->string('stat_2_value')->nullable();
            $table->string('stat_2_label')->nullable();
            $table->string('stat_3_value')->nullable();
            $table->string('stat_3_label')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('carousel_slides');
    }
};