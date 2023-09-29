<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('update_images')->insert([
            'updates_id' => 1,
            'url' => 'images/n3isrh5XDbagccN5U9FuCrDANxN1Kep5W1GdfXah.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 1,
            'url' => 'images/EKIfH5gZtJ6UUljbcTXdjv7UNa9aOxB6Ka1MKEDC.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 1,
            'url' => 'images/rCAbXiZQdXJELUGRoCuZJnODafYrlSl8lMpGI4ca.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('update_images')->insert([
            'updates_id' => 2,
            'url' => 'images/LXInmwViokVnqsyWiXW1xVv0gq1bw3NJFNAcf63n.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 2,
            'url' => 'images/eYQXe6yga94PAn273VPuNp9irqSRLTjQKzjKy9fu.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 2,
            'url' => 'images/ulsBv9PZHWUtod3aCHjNeBSmER5qAgThdTFSL5nL.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('update_images')->insert([
            'updates_id' => 3,
            'url' => 'images/TZtqV9Jr9E84rlBhnwM2XjI32FxaPrQwR5Yn5sC2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 3,
            'url' => 'images/wrrvirp8ByukTzFnRKRGsPW1FDCx6t9I72ttxDSz.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 3,
            'url' => 'images/8oIH5nwSykPVTzMa44Itb90xDucE39v8HtWctYan.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('update_images')->insert([
            'updates_id' => 4,
            'url' => 'images/fjCW7e7dLTBdl2k42GzzThEZ8Xk1o7wkdltjws60.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 4,
            'url' => 'images/awYoPoFtUF6kM3CGL2rT8Ab8HWCGmRsRFr0uO1ml.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('update_images')->insert([
            'updates_id' => 4,
            'url' => 'images/Oq8fAFWv9mjpu1Y21fF1Kbal9DXxw46KU7mkGL75.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
