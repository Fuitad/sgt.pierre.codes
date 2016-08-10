<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'email' => 'stoutzero@example.com',
      'username' => 'stoutZero',
      'role' => 'admin',
    ]);

    User::create([
      'email' => 'admin@localhost',
      'username' => 'admin',
      'role' => 'admin',
    ]);

    factory(User::class, rand(13, 23));
  }
}
