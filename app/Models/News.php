<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content', 'image_data', 'image_type', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image_data) {
            if (str_starts_with($this->image_data, 'data:image')) {
                return $this->image_data;
            }
            return 'data:image/'.$this->image_type.';base64,'.$this->image_data;
        }
        return asset('images/default-service.jpg');
    }
}
