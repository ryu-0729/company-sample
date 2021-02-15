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
        // シードデータの追加

        // 社員
        /* DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
            'role' => '社員',
        ]);

        // システム開発者
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
            'role' => '開発者',
        ]);
        
        // 管理者（社長）
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gamil.com',
            'password' => Hash::make('baseball'),
            'role' => '管理者',
        ]); */

        factory(App\User::class, 50)->create();

    }
}
