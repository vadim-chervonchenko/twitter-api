<?php

use Illuminate\Database\Seeder;
use App\Models\Tweet;

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
            'password' => 'admin'
        ])->tweets()->saveMany(factory(Tweet::class, 3)->make());

        factory(User::class, 5)->create()
            ->each(function ($user) {
                $user->tweets()->saveMany(factory(Tweet::class, 3)->make());
            });
    }
}
