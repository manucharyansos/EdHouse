<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'image_data', 'image_type'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        if ($this->image_data && $this->image_type) {
            return "data:image/{$this->image_type};base64,{$this->image_data}";
        }
        return asset('images/default-image.jpg');
    }
}
