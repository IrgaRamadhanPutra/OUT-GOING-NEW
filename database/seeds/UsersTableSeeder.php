<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        //untuk pass uer irga = 14253687
        $password = '12345678'; // Ganti dengan kata sandi yang diinginkan
        $hashedPassword = Hash::make($password);

        // Generate unique nik value
        $uniqueNik = '';
        do {
            $uniqueNik = mt_rand(100000, 999999); // Generate random 6-digit number
        } while (DB::table('users')->where('nik', $uniqueNik)->exists());

        DB::table('users')->insert([
            'name' => 'John Doe',
            'nik' => $uniqueNik,
            'email' => 'johndoe@example.com',
            'password' => $hashedPassword,
        ]);
    }
}
