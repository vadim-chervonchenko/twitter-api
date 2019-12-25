<?php

use Illuminate\Database\Seeder;
use App\Models\Tweet;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@user.com',
            'password' => 'qwerty'
        ])->tweets()->saveMany(factory(Tweet::class, 3)->make());
    }
}
