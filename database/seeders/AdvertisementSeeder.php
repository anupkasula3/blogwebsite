<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advertisements = [
            [
                'title' => 'Premium Hosting Service',
                'description' => 'Get 50% off on premium hosting plans. Fast, secure, and reliable.',
                'link' => 'https://example.com/hosting',
                'position' => 'header',
                'is_active' => true,
            ],
            [
                'title' => 'Web Design Course',
                'description' => 'Learn modern web design with our comprehensive online course.',
                'link' => 'https://example.com/webdesign',
                'position' => 'sidebar',
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing Tools',
                'description' => 'Boost your business with our suite of digital marketing tools.',
                'link' => 'https://example.com/marketing',
                'position' => 'content',
                'is_active' => true,
            ],
            [
                'title' => 'Premium Newsletter',
                'description' => 'Subscribe to our premium newsletter for exclusive content and insights.',
                'link' => 'https://example.com/newsletter',
                'position' => 'footer',
                'is_active' => true,
            ],
        ];

        foreach ($advertisements as $ad) {
            Advertisement::create($ad);
        }
    }
}
