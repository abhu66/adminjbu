<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Leader;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
        'status', //1 = pending payment, 2 = paid/approved, 3 = Cancel, 4 waiting approval
        'reward',
        'sender_name',
        'url_proof_image',
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

}
