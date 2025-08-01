<?php

namespace App\Http\Controllers;

use App\Models\BackgroundImage;
use App\Models\BackgroundVideo;
use App\Models\News;
use App\Models\Project;
use App\Models\ProjectsCategories;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $projects = Project::with('categories')->get();
        $categories = ProjectsCategories::with('projects')->get();
        $backgroundImage = BackgroundImage::latest()->first();
        $backgroundVideo = BackgroundVideo::latest()->first();
        $news = News::latest()->take(3)->get();
        $services = Service::all();

        return Inertia::render('Home', [
            'projects' => $projects,
            'categories' => $categories,
            'backgroundImage' => $backgroundImage ? asset($backgroundImage->image_url) : asset('/img/header-bg-parallax-01-1922x1030.jpg'),
            'backgroundVideo' => $backgroundVideo ? asset($backgroundVideo->video_url) : asset('/img/about-01-569x488.jpg'),
            'news' => $news,
            'services' => $services
        ]);
    }

}
