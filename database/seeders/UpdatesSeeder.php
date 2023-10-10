<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('updates')->insert([
            'title' => 'New Product Launch - Introducing the XYZ Pro Series',
            'description' => '<p>We are thrilled to announce the release of our latest innovation, the XYZ Pro Series! This cutting-edge product is designed to revolutionize your daily life with its advanced features and sleek design. Explore the future of technology with the XYZ Pro Series.</p>',
            'cover_photo' => 'images/4wTW6AGwoWeNs5zRGvwBf8cGLrADABU8KvIzdTP1.jpg',
            'tag_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('updates')->insert([
            'title' => 'Important Event Notice - Annual Charity Gala',
            'description' => '<p>Join us for our Annual Charity Gala on [Date] at [Venue]. This event promises an evening of glamour, entertainment, and philanthropy. Your participation will support local charities and make a positive impact on our community. Get your tickets now!</p>',
            'cover_photo' => 'images/ndGB5naksTCfjMySb1osukNNiMr5UgKEmNqpk9em.jpg',
            'tag_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('updates')->insert([
            'title' => 'Job Opportunity - Senior Marketing Manager',
            'description' => '<p>Are you a seasoned marketing professional looking for a new challenge? We are hiring a Senior Marketing Manager to lead our dynamic team. If youre passionate about driving growth and innovation, we want to hear from you! Apply today and be part of our exciting journey.</p>',
            'cover_photo' => 'images/MLmSnIsq9Bem6SoTcwMzMeo12TActdWW9lavZRtc.jpg',
            'tag_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('updates')->insert([
            'title' => 'Exciting News - Company Expansion',
            'description' => '<p>We are delighted to share that our company is expanding! With a new office opening in [Location], were dedicated to serving our customers even better. Stay tuned for updates on our progress and how this expansion will benefit you, our valued clients.</p>',
            'cover_photo' => 'images/i8qFfEDmV6RT0HcATPtT87PXdLoNWKItK1z09Qk7.jpg',
            'tag_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('updates')->insert([
            'title' => 'Community Announcement - Neighborhood Cleanup Day',
            'description' => '<p>Lets come together to make our neighborhood shine! Join us for Neighborhood Cleanup Day on [Date]. Well be picking up litter, planting trees, and beautifying our community. Together, we can create a cleaner and greener environment for everyone.</p>',
            'cover_photo' => 'images/7O6PbfuWyaJS4jhz9JEM3XY0dMwmAxjPl1uQVali.jpg',
            'tag_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
