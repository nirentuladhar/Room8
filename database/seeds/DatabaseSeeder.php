<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(HouseTableSeeder::class);
        $this->call(HouseUserTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(GroupUserTableSeeder::class);
        $this->call(TransactionTableSeeder::class);
        $this->call(PayablesTableSeeder::class);
    }
}
