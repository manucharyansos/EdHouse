<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'url'];

    protected $appends = ['image_url'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->url ? asset('img/' . $this->url) : asset('img/default-project.jpg');
    }
}
