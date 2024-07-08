<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Sorter;
use App\Models\Ticket;
use App\Models\Lottery;
use App\Models\Administrator;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        

        Sorter::factory()->create([
            'name' => 'Sorteador',
            'age'=>23,
            'email' => 'test@example.com',
        ]);
        Administrator::factory()->create([
            'name'=>'Antonio Barraza',
            'email'=>'antonio.barraza.guzman@gmail.com',
            'password'=>Hash::make('Luckygo23',
            )]);
    }   
}
