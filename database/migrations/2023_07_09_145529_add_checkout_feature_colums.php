<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('quantity')->after('order_id');
            $table->integer('price')->after('quantity');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('level')->default(1)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('price');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};
