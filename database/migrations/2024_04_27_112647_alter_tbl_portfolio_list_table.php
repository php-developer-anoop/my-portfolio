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
        Schema::table('tbl_portfolio_list',function (Blueprint $table){
            $table->string("project_category",100)->after("id");
            $table->string("project_image",100)->after("short_description");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_portfolio_list',function (Blueprint $table){
            $table->dropColumn("project_category");
            $table->dropColumn("project_image");
        });
    }
};
