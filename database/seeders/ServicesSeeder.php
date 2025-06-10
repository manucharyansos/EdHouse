<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'svg' => 'project-01-420x357.jpg',
                'name' => 'Վերափոխում',
                'description' => 'Մեր մասնագետների թիմը տարիների փորձ ունի տների, այդ թվում՝ խոհանոցների, նկուղների վերանորոգման գործում։',
            ],
            [
                'svg' => 'img/news-full-width-03-572x612.jpg',
                'name' => 'Ինտերիերի դիզայն',
                'description' => 'Մեր ինտերիերի դիզայնի ծառայությունները լավագույն միջոցն են ձեզ և ձեր կենսակերպին լիովին համապատասխանող տան դիզայն ստանալու համար։',
            ],
            [
                'svg' => 'project-04-420x357.jpg',
                'name' => 'Շինարարություն',
                'description' => 'Շինարարություն
Մենք բարձրորակ շինարարական ծառայություններ ենք մատուցում էներգետիկայի, ջրի և հեռահաղորդակցության շուկաներին։',
            ],
            [
                'svg' => 'img/news-full-width-03-572x612.jpg',
                'name' => 'Այլ ծառայություններ',
                'description' => 'Մենք առաջարկում ենք ավելի շատ ծառայություններ, քան որևէ այլ շինարարական ընկերություն։ Ծառայությունների ամբողջական ցանկը հասանելի է մեր կայքում։',
            ],
        ];

        foreach ($services as $item) {
            Service::create($item);
        }
    }
}
