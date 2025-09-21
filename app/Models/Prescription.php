<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Prescription extends Model
{
    //
    protected $fillable = [
        'user_id',
        'note',
        'delivery_address',
        'delivery_slot',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(PrescriptionImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
