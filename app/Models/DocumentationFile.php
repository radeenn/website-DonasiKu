<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentationFile extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'file_type',
    ];

    public function getIsImageAttribute(): bool
    {
        return in_array(strtolower((string) $this->file_type), ['png', 'jpg', 'jpeg', 'webp'], true);
    }

    public function getPublicUrlAttribute(): string
    {
        return asset('storage/' . ltrim((string) $this->file_path, '/'));
    }
}
