<?php

use Illuminate\Database\Seeder;
use\App\Models\Tweet;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::create([
            'content' => 'First admin post',
            'author_id' => '1'
        ]);
    }
}
