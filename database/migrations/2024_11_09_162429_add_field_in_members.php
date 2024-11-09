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
        Schema::table('members', function (Blueprint $table) {
            $table->string('no_rekening');
            $table->string('address');
            $table->string('nama_bank');
            $table->string('nama_rekening');
            $table->bigInteger('sponsor_id');
        });
        Schema::table('leaders', function (Blueprint $table) {
            $table->string('phone_number');
            $table->string('no_rekening');
            $table->string('email');
            $table->string('nama_bank');
            $table->string('nama_rekening');
            $table->foreignId('owner_id')->constrained('owners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
};
