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
        Administrator::factory()->create(['name'=>'Antonio Barraza',
    'email'=>'antonio.barraza.guzman@gmail.com','password'=>Hash::make('Luckygo23')]);
        Lottery::factory()->create(["date"=>Carbon::parse("2024-05-19"),'id'=>1,"state"=>0] );
        Ticket::factory()->create(['code'=> '111','numbers'=>"\"['1','2','3','4','5']\"","price"=> 2000,"im_feeling_lucky"=>0,"date"=>Carbon::parse("2024-05-15"),"lottery_id"=>1]);
    }   
}
