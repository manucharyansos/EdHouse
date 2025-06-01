<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'location', 'architect', 'image'];

    protected $appends = ['image_url'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProjectsCategories::class, 'category_project', 'project_id', 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('img/' . $this->image) : asset('img/default-project.jpg');
    }
}
