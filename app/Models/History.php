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
        if ($this->image && file_exists(public_path('storage/app/public/' . $this->image))) {
            return url('storage/app/public/' . $this->image);
        }
        return asset('images/default-history.jpg');
    }
}
