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
       Schema::create('transactions', function (Blueprint $table) {
           $table->string('transaction_code')->nullable();
           $table->timestamp('transaction_date')->useCurrent();
           $table->foreignId('product_id');
           $table->foreignId('member_id');
           $table->foreignId('leader_id');
           $table->foreignId('sponsor_id');
           $table->decimal('price', 15, 2)->default(0.00);
           $table->string('no_wa', 15)->nullable();
           $table->decimal('komisi_referral', 15, 2)->default(0.00);
           $table->decimal('komisi_sponsor', 15, 2)->default(0.00);
           $table->decimal('komisi_leader', 15, 2)->default(0.00);
           $table->integer('status')->default(1); // 1 = pending payment
           $table->decimal('reward', 15, 2)->default(0.00);
       });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
