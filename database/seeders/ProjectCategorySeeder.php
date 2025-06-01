<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectsCategories;
use App\Models\ProjectImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Շինարարություն'],
            ['name' => 'Վերափոխում'],
            ['name' => 'Ինտերիերի դիզայն'],
        ];

        $placeholderImages = [
            'project-01-420x357.jpg',
            'project-02-420x357.jpg',
            'project-03-420x357.jpg',
            'project-04-420x357.jpg',
            'project-05-420x357.jpg',
        ];

        $galleryImages = [
            'project-01-420x357.jpg',
            'project-02-420x357.jpg',
            'project-03-420x357.jpg',
            'project-04-420x357.jpg',
        ];

        $locations = [
            'Southern Los Angeles',
            'Downtown Yerevan',
            'Northern Gyumri',
        ];

        $architects = [
            'Christian Wayne',
            'Anna Smith',
            'David Jones',
        ];

        foreach ($categories as $index => $categoryData) {
            $category = ProjectsCategories::create($categoryData);

            for ($i = 1; $i <= 5; $i++) {
                $project = Project::create([
                    'name' => $categoryData['name'] . ' Պրոեկտ ' . $i,
                    'description' => 'Սա ' . $categoryData['name'] . ' կատեգորիայի պրոեկտ ' . $i . ' է։',
                    'location' => $locations[$index % count($locations)],
                    'architect' => $architects[$index % count($architects)],
                    'image' => $placeholderImages[$i - 1],
                ]);

                foreach ($galleryImages as $galleryImage) {
                    $project->images()->create([
                        'url' => $galleryImage,
                    ]);
                }

                $category->projects()->attach($project->id);
            }
        }
    }
}
