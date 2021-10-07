<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id');

        foreach ($users as $userId) {
            Post::factory()->count(rand(4, 9))->create([
                'user_id' => $userId
            ]);
        }
    }
}
