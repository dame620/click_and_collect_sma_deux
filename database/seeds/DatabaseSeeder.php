<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(StatutSeeder::class);

        factory(User::class)->create([
           // 'name'  => 'Papa Mouhamadou DIOP',
           // 'email' => 'kaiserification@gmail.com',
        ]);
    }
}
