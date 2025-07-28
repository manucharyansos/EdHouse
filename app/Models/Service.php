<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['image_data', 'image_type', 'name', 'description'];

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
