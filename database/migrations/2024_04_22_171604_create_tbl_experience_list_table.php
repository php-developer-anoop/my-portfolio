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
        Schema::create('tbl_experience_list', function (Blueprint $table) {
            $table->id();
            $table->string('from_year',10)->nullable(true)->collation("utf8mb4_general_ci");
            $table->string('to_year',20)->nullable(true)->collation("utf8mb4_general_ci");
            $table->string('position',20)->nullable(true)->collation("utf8mb4_general_ci");
            $table->text('description')->nullable(true)->collation("utf8mb4_general_ci");
            $table->enum('status',['Active','Inactive'])->nullable(true)->collation("utf8mb4_general_ci");
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_experience_list');
    }
};
