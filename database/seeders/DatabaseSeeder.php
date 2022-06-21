<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name='admin';
        $user->password=Hash::make('admin');
        $user->email='admin@admin.com';
        $user->rol='admin';
        $user->dni='12345678A';

        $user->save();

        $user = new User();
        $user->name='empleat';
        $user->password=Hash::make('empleat');
        $user->email='empleat@empleat.com';
        $user->rol='empleat';
        $user->dni='87654321A';

        $user->save();
    }
}
