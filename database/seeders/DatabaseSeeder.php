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
        Lottery::factory()->create([
            "date"=>Carbon::parse("2024-06-30"),
            'id'=>1,"status"=>0,
            ] );
        Lottery::factory()->create([
                "date"=>Carbon::parse("2024-07-7"),
                'id'=>2,"status"=>0,
                ] );
        Ticket::factory()->create([
            'code'=> '111',
            "price"=> 2000,
            "number_1"=>1,
            "number_2"=>2,
            "number_3"=>3,
            "number_4"=>4,
            "number_5"=>5,
            "im_feeling_lucky"=>0,
            "date"=>Carbon::parse("2024-06-29"),
            "lottery_id"=>1,
        ]);
        Ticket::factory()->create([
            'code'=> '112',
            "price"=> 3000,
            "number_1"=>1,
            "number_2"=>2,
            "number_3"=>3,
            "number_4"=>4,
            "number_5"=>5,
            "im_feeling_lucky"=>1,
            "date"=>Carbon::parse("2024-07-05"),
            "lottery_id"=>2,
        ]);
        Ticket::factory()->create([
            'code'=> '113',
            "price"=> 3000,
            "number_1"=>7,
            "number_2"=>2,
            "number_3"=>3,
            "number_4"=>4,
            "number_5"=>5,
            "im_feeling_lucky"=>1,
            "date"=>Carbon::parse("2024-07-06"),
            "lottery_id"=>2,
        ]);
    }   
}
