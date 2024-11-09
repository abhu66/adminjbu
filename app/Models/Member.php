<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Member;
use App\Models\User;
use App\Models\Leader;
use Illuminate\Support\Facades\Auth;

class Member extends Model
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
        'address',
        'nama_bank',
        'nama_rekening',
        'leader_id',
        'sponsor_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Get the leader that owns the member.
     */
    public function leader()
    {
        return $this->belongsTo(Leader::class);
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

    // Define relationships for created_by and updated_by
    public function leaders()
    {
        return $this->belongsTo(Leader::class, 'leader_id');
    }


    // Define relationships for created_by and updated_by
    public function sponsor()
    {
        return $this->belongsTo(Member::class, 'sponsor_id');
    }

}
