<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'target_donation',
        'collected_donation',
        'deadline',
    ];

    // Relasi One-to-One: satu campaign memiliki satu rekening penerimaan donasi.
    public function account(): HasOne
    {
        return $this->hasOne(CampaignAccount::class);
    }

    // Relasi One-to-Many: satu campaign dapat memiliki banyak data donasi.
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    // Relasi Many-to-Many: satu campaign dapat memiliki banyak kategori.
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'campaign_category');
    }
}
