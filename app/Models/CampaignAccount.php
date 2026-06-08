<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignAccount extends Model
{
    protected $fillable = [
        'campaign_id',
        'bank_name',
        'account_number',
        'account_holder',
    ];

    // Relasi kebalikan: rekening ini dimiliki oleh satu campaign.
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
