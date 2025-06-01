<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProjectsCategories extends Model
{
    protected $table = 'projects_categories';
    protected $fillable = ['name'];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'category_project', 'category_id', 'project_id');
    }
}
