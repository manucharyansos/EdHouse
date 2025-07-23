<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['svg', 'name', 'description'];

    protected $appends = ['image_url'];
//

    public function getImageUrlAttribute(): ?string
    {
        if ($this->svg && file_exists(public_path('storage/' . $this->svg))) {
            return url('storage/' . $this->svg);
        }
        return url('project-04-420x357.jpg');
    }
}
