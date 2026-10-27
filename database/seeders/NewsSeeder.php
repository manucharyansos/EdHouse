<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'title' => 'Նկարչության համար սենյակ պատրաստելը',
                'content' => 'Նկարելու համար սենյակ պատրաստելը սենյակ նկարելիս միակ ամենակարևոր քայլն է:',
                'image_path' => 'img/news-full-width-01-572x612.jpg',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Վերանորոգման և վերափոխման գաղափարներ',
                'content' => 'Տան վերանորոգումը պահանջում է թե՛ հմտություններ, թե՛ ներշնչանք։ Այստեղ դուք կգտնեք տեղեկատվություն լավագույն նյութերի մասին։',
                'image_path' => 'img/news-full-width-02-572x612.jpg',
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Շինարարական նախագծի պլանավորում',
                'content' => 'Կա մեծ գայթակղություն անմիջապես նետվելու տան վերանորոգման աշխատանքների մեջ։ Որքան շուտ սկսես, այնքան...',
                'image_path' => 'img/news-full-width-03-572x612.jpg',
                'published_at' => now(),
            ],
        ];

        foreach ($news as $item) {
            $imageFullPath = public_path($item['image_path']);
            if (!file_exists($imageFullPath)) {
                dump("❌ Image not found:", $imageFullPath);
                continue;
            }

            $imageData = base64_encode(file_get_contents($imageFullPath));
            $imageType = pathinfo($imageFullPath, PATHINFO_EXTENSION);

            News::create([
                'title' => $item['title'],
                'content' => $item['content'],
                'image_data' => $imageData,
                'image_type' => $imageType,
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
