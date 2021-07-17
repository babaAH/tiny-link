<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            DB::table("users")->insert([
                "name" => "admin",
                "email" => env("ADMIN_DEFAULT_EMAIL","admin@admin.com"),
                "password" => Hash::make(env("ADMIN_DEFAULT_PASSWORD", "password")),
            ]);
            DB::commit();
        }catch (\Throwable $th){
            DB::rollback();
            dd($th);
        }
    }
}
