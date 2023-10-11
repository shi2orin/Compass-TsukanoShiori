<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                    [
                        'over_name' => '田中',
                        'under_name' => '一郎',
                        'over_name_kana' => 'タナカ',
                        'under_name_kana' => 'イチロウ',
                        'mail_address' => 'tanakaichiro@example.com',
                        'sex' => 1,
                        'birth_day' => '2000-01-01',
                        'role' => 4,
                        'password' => bcrypt('password1'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'over_name' => '田中',
                        'under_name' => '次郎',
                        'over_name_kana' => 'タナカ',
                        'under_name_kana' => 'ジロウ',
                        'mail_address' => 'tanakajiro@example.com',
                        'sex' => 1,
                        'birth_day' => '2000-01-01',
                        'role' => 2,
                        'password' => bcrypt('password2'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'over_name' => '田中',
                        'under_name' => '三郎',
                        'over_name_kana' => 'タナカ',
                        'under_name_kana' => 'サブロウ',
                        'mail_address' => 'tanakasaburo@example.com',
                        'sex' => 1,
                        'birth_day' => '2000-01-01',
                        'role' => 1,
                        'password' => bcrypt('password3'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
}
