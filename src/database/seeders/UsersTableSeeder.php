<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
       User::create([
        'id' => 1,
        'name' => 'testuser1',
        'email' => 'user1@attetest.com',
        'password' => '$2y$10$r9DGd9vxF4gxRFXoXdJIbupdMr0e5nMLhyPtcrziO6WgfHmFTFhCC',
       ]);

       User::create([
        'id' => 2,
        'name' => 'testuser2',
        'email' => 'user2@attetest.com',
        'password' => '$2y$10$r9DGd9vxF4gxRFXoXdJIbupdMr0e5nMLhyPtcrziO6WgfHmFTFhCC',
       ]);
    }
}
