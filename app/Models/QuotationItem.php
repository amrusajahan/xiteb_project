<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Quotation;

class QuotationItem extends Model
{
    protected $fillable = [
        'quotation_id',
        'drug_name',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }
}
