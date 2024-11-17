<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Leader;
use App\Models\Member;
use App\Models\Owner;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletCommission extends Model
{

    use HasFactory;

    protected $table = "wallet_commission";

    /**
     * fillable
     *
     * @var array
     */


    protected $fillable = [
        'ref_id',
        'ref_type',
        'type',
        'amount',
        'transaction_code'
    ];


 // Add boot method to set created_by and updated_by automatically
    protected static function boot()
    {
        parent::boot();

//         static::creating(function ($model) {
//             $model->created_by = Auth::id(); // Set the created_by field
//             $model->updated_by = Auth::id(); // Set the updated_by field when creating
//         });

//         static::updating(function ($model) {
//             $model->updated_by = Auth::id(); // Update the updated_by field when updating
//         });
    }



    public function member()
    {
        return $this->belongsTo(Member::class, 'ref_id', 'id');
    }

    public function leader()
    {
        return $this->belongsTo(Leader::class, 'ref_id', 'id');
    }

    public function owners()
        {
            return $this->belongsTo(Owner::class, 'ref_id', 'id');
        }

}
