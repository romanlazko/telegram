<?php

namespace Romanlazko\Telegram\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Roman Lazko',
            'email' => 'romanlazko@gmail.com',
            'password' => bcrypt('zdraste123'),
            'chat_id' => 544883527,
        ]);
    }
}
