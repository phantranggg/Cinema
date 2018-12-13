<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'email' => 'user' . $i . '@gmail.com',
                'password' => bcrypt('123456'),
                'name' => 'user' . $i,
                'role_id' => 2,
                'active' => 1,
                'avatar' => 'uploads/users/avatars/default.png',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
