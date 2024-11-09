<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Leader;

class Transaction extends Model
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'transaction_code',
        'transaction_date',
        'price',
        'product_id',
        'member_id',
        'leader_id',
        'sponsor_id',
        'no_wa',
        'komisi_referral',
        'komisi_sponsor',
        'komisi_leader',
        'status', //1 = pending payment, 2 = payment, 3 = Cancel
        'reward'

    ];


 // Add boot method to set created_by and updated_by automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id(); // Set the created_by field
            $model->updated_by = Auth::id(); // Set the updated_by field when creating
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id(); // Update the updated_by field when updating
        });
    }


//        $table->string('transaction_code')->nullable();
//                 $table->timestamp('transaction_date')->useCurrent();
//                 $table->foreignId('product_id');
//                 $table->foreignId('member_id');
//                 $table->foreignId('leader_id');
//                 $table->foreignId('sponsor_id');
//                 $table->decimal('price', 15, 2)->default(0.00);
//                 $table->string('no_wa', 15)->nullable();
//                 $table->decimal('komisi_referral', 15, 2)->default(0.00);
//                 $table->decimal('komisi_sponsor', 15, 2)->default(0.00);
//                 $table->decimal('komisi_leader', 15, 2)->default(0.00);
//                 $table->integer('status')->default(1); // 1 = pending payment
//                 $table->decimal('reward', 15, 2)->default(0.00);

}
