<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("roles")->insert([
            ["name" => "author"],
            ["name" => "editor"],
            ["name" => "admin"],
        ]);hese credentials do not match our records.hese credentials do not match our records.hese credentials do not match our records.hese credentials do not match our records.
    }
}
