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
        Schema::create('tbl_enquiry_list', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->nullable(true);
            $table->string('email',150)->nullable(true);
            $table->string('subject',150)->nullable(true);
            $table->string('message',1000)->nullable(true);
            $table->dateTime('add_date')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_enquiry_list');
    }
};
