<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->session = '';
        $user->name = 'Hans';
        $user->email = 'hans.castro@solidjobs.org';
        $user->password = Hash::make('1');
        $user->setCreatedAt(time());

        $user->save();
    }
}
