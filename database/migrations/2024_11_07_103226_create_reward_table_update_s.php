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
        Schema::create('rewards', function (Blueprint $table) {
             $table->string('name');
             $table->string('poin');
             $table->string('hadiah');
             $table->string('individu')->nullable();;
             $table->string('amir');
             $table->unsignedBigInteger('created_by')->nullable(); // Assuming it references a user
             $table->unsignedBigInteger('updated_by')->nullable(); // Assuming it references a user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_table_update');
    }
};