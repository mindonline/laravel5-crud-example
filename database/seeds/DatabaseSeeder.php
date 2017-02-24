<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'id' => '1',
                'name' => 'Moscow'
            ],
            [
                'id' => '2',
                'name' => 'Tokio'
            ],
            [
                'id' => '3',
                'name' => 'New York'
            ],
            [
                'id' => '4',
                'name' => 'Chelyabinsk'
            ]
        ]);

        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'customer'
            ],
            [
                'id' => '2',
                'name' => 'seller'
            ],
            [
                'id' => '3',
                'name' => 'moderator'
            ],
            [
                'id' => '4',
                'name' => 'admin'
            ]
        ]);
    }
}
