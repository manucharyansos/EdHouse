<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectsCategories;


class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Շինարարություն'],
            ['name' => 'Վերափոխում'],
            ['name' => 'Ինտերիերի դիզայն'],
        ];

        $placeholderImages = [
            'images/project-01-420x357.jpg',
            'images/project-02-420x357.jpg',
            'images/project-03-420x357.jpg',
            'images/project-04-420x357.jpg',
            'images/project-05-420x357.jpg',
        ];

        $galleryImages = [
            'images/project-01-420x357.jpg',
            'images/project-02-420x357.jpg',
            'images/project-03-420x357.jpg',
            'images/project-04-420x357.jpg',
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
                $imagePath = public_path($placeholderImages[$i - 1]);
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);

                $project = Project::create([
                    'name' => $categoryData['name'] . ' Պրոեկտ ' . $i,
                    'description' => 'Սա ' . $categoryData['name'] . ' կատեգորիայի պրոեկտ ' . $i . ' է։',
                    'location' => $locations[$index % count($locations)],
                    'architect' => $architects[$index % count($architects)],
                    'image_data' => $imageData,
                    'image_type' => $imageType,
                ]);

                foreach ($galleryImages as $galleryImage) {
                    $galleryPath = public_path($galleryImage);
                    $galleryData = base64_encode(file_get_contents($galleryPath));
                    $galleryType = pathinfo($galleryPath, PATHINFO_EXTENSION);

                    $project->images()->create([
                        'image_data' => $galleryData,
                        'image_type' => $galleryType,
                    ]);
                }

                $category->projects()->attach($project->id);
            }
        }
    }
}
