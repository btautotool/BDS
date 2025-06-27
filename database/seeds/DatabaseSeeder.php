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
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'image' => 'user.png',
                'about' => 'Quản trị website',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'role_id' => 2,
                'name' => 'Chủ nhà đất',
                'username' => 'agent',
                'email' => 'vudinhtuan242@gmail.com',
                'image' => 'user.png',
                'about' => '',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'role_id' => 3,
                'name' => 'Người dùng',
                'username' => 'user',
                'email' => 'user@user.com',
                'image' => 'user.png',
                'about' => null,
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);

        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Agent',
                'slug' => 'agent',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
