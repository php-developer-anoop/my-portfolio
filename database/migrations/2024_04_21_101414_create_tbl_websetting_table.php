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
        Schema::create('tbl_websetting', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',10)->nullable(true);
            $table->string('last_name',10)->nullable(true);
            $table->string('age',2)->nullable(true);
            $table->string('experience',20)->nullable(true);
            $table->string('linkedin_link',20)->nullable(true);
            $table->string('facebook_link',20)->nullable(true);
            $table->string('mobile_number',10)->nullable(true);
            $table->string('email',50)->nullable(true);
            $table->string('address',100)->nullable(true);
            $table->string('role',100)->nullable(true);
            $table->string('short_description',150)->nullable(true);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_websetting');
    }
};
