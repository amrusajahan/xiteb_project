<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Prescription;
use App\Models\QuotationItem;
use App\Models\User;

class Quotation extends Model
{
    protected $fillable = [
        'prescription_id',
        'pharmacy_id',
        'status',
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pharmacy_id');
    }
}
