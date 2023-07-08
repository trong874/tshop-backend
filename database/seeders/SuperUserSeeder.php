<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();

        User::create([
            'username'=>'admin',
            'email'=>'pvt874@gmail.com',
            'account_type'=>1,
            'password'=>bcrypt('ekun4421'),
        ]);
    }
}
