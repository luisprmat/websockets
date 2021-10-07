<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Luis Parrado',
            'email' => 'luisprmat@gmail.com'
        ]);

        User::factory()->count(39)->create();
    }
}
