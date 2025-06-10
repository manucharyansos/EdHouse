<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    use HasFactory;
    protected $fillable = [
        'year',
        'title',
        'content',
        'image'
    ];

    protected $appends = ['image_url'];
//
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : asset('img/default-project.jpg');
    }
}
