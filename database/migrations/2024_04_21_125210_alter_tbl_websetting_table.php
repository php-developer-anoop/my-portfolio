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
        Schema::table('tbl_websetting', function (Blueprint $table) {
            $table->string('linkedin_link',200)->nullable(true);
            $table->string('facebook_link',200)->nullable(true);
            $table->string('twitter_link',200)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_websetting', function(Blueprint $table) {
            $table->dropColumn('linkedin_link');
            $table->dropColumn('facebook_link');
            $table->dropColumn('twitter_link');
        });
    }
};
