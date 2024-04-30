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
        Schema::create('tbl_portfolio_list', function (Blueprint $table) {
            $table->id();
            $table->string('project_name',200)->nullable(true); 
            $table->string('project_url',200)->nullable(true); 
            $table->string('short_description',250)->nullable(true); 
            $table->enum('status',['Active','Inactive'])->default('Active');  
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_portfolio_list');
    }
};
