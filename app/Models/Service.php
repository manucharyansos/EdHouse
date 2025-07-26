<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'image_data'];

//    public function getImageUrlAttribute(): string
//    {
//        if ($this->image && Storage::disk('public')->exists($this->image)) {
//            return Storage::disk('public')->url($this->image);
//        }
//        return asset('images/default-service.jpg');
//    }
}
