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
        return $this->svg ? asset('storage/' . $this->svg) : asset('/project-04-420x357.jpg');
    }
}
