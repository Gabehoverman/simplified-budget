<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(array(
            'name' => 'Test Admin',
            'email' => 'Admin@admin.com',
            'password' =>Hash::make('password')
        ));

        $user->save();
    }
}
