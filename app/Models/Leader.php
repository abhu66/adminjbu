<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Leader extends Model
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
        'no_rekening',
        'nama_bank',
        'nama_rekening',
        'owner_id',
        'password',
        'image',
        'referal_code',
        'created_by',
        'updated_by', // Add these columns
    ];


    public function members()
    {
        return $this->hasMany(Member::class);
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by'); // Ensure 'created_by' is the correct foreign key
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by'); // Ensure 'updated_by' is the correct foreign key
    }
}
