<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Leader;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Owner extends Model
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'created_by',
        'updated_by'

    ];


    public function leaders()
    {
        return $this->hasMany(Leader::class);
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
