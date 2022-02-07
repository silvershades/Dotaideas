<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data = [
            'name' => 'Matias',
            'email' => 'capriulomatias@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$M0aDweCyGFDk6hWCal25.OsussAhrievSV/hvb9JW7T5u6XY6EOVu', // password
            'remember_token' => 'u0FXZCJA0d',
            'created_at' => '2022-01-12 21:57:31',


        ];
        DB::table('users')->insert($data);

        $user = User::where('id', 1)->first();

        $posts = Post::factory()
            ->count(20)
            ->sequence(
                ['post_type_id' => "1"],
                ['post_type_id' => "2"],
                ['post_type_id' => "3"],
            )
            ->for($user)
            ->create();
    }
}
