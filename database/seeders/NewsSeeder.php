<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Նկարչության համար սենյակ պատրաստելը',
                'content' => 'Նկարելու համար սենյակ պատրաստելը սենյակ նկարելիս միակ ամենակարևոր քայլն է:',
                'image' => 'img/news-full-width-01-572x612.jpg',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Վերանորոգման և վերափոխման գաղափարներ',
                'content' => 'Տան վերանորոգումը պահանջում է թե՛ հմտություններ, թե՛ ներշնչանք։ Այստեղ դուք կգտնեք տեղեկատվություն լավագույն նյութերի մասին։',
                'image' => 'img/news-full-width-02-572x612.jpg',
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Շինարարական նախագծի պլանավորում',
                'content' => 'Կա մեծ գայթակղություն անմիջապես նետվելու տան վերանորոգման աշխատանքների մեջ։ Որքան շուտ սկսես, այնքան...',
                'image' => 'img/news-full-width-03-572x612.jpg',
                'published_at' => now(),
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
