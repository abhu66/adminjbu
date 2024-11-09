<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'url_image',
        'komisi_referral',
        'komisi_sponsor',
        'komisi_leader',
        'owners_id',
        'created_by',
        'updated_by'
    ];


    /**
     * Get the leader that owns the member.
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

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

// Define relationships for created_by and updated_by
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
