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
        Schema::create('tbl_education_list', function (Blueprint $table) {
            $table->id();
            $table->string('pass_year',4)->nullable(true);
            $table->string('title',50)->nullable(true);
            $table->string('institution',150)->nullable(true);
            $table->string('institution_place',150)->nullable(true);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_education_list');
    }
};
