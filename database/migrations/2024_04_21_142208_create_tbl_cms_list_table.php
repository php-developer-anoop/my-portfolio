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
        Schema::create('tbl_cms_list', function (Blueprint $table) {
            $table->id();
            $table->string('page_name',150)->nullable(true);
            $table->string('page_slug',200)->nullable(true);
            $table->string('meta_title',200)->nullable(true);
            $table->string('meta_description',200)->nullable(true);
            $table->string('meta_keywords',200)->nullable(true);
            $table->string('short_description',200)->nullable(true);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cms_list');
    }
};
