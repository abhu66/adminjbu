<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('leaders', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable(); // Assuming it references a user
            $table->unsignedBigInteger('updated_by')->nullable(); // Assuming it references a user

            // Optional: Add foreign key constraints if 'created_by' and 'updated_by' reference a users table
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('leaders', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by']);
        });
    }
};
