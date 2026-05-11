<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Only add columns that don't already exist
            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false)->after('password');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['customer', 'admin', 'super_admin'])->default('customer')->after('is_admin');
            }
            if (!Schema::hasColumn('users', 'permissions')) {
                $table->json('permissions')->nullable()->after('role');
                // Permissions example: {"manage_products":true,"manage_orders":true,"manage_reviews":true,"manage_team":true,"manage_admins":false}
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('permissions');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable();
            }
        });
    }
 
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'permissions', 'is_active', 'phone', 'last_login_at']);
        });
    }
};
 