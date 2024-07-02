<?php

namespace Tests\Unit;

use App\Models\Administrator;
use App\Models\Sorter;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    //For admin test
    public function test_change_password_admin():void{

        $administrator = Administrator::factory()->create(["name"=>"test1","email"=>"test10@test1.com","password"=>'password']);
        $password = Hash::make('password');
        $this->actingAs($administrator);
        $response = $this->postJson(route('change_password', ['password1' => 123123 , 'password2' => 123123]));
        $administrator->refresh();
        $this->assertTrue($administrator->password!=$password);

    }

    //For sorter test

    public function test_change_password_sorter():void{

        $sorter = Sorter::factory()->create(["name"=>"test2","age"=>40,"email"=>"test@test.com","password"=>"password","status"=>1]);
        $password = Hash::make('password');
        $this->actingAs($sorter);
        $response = $this->postJson(route('change_password', ['password1' => 123123 , 'password2' => 123123]));
        $sorter->refresh();
        $this->assertTrue($sorter->password!=$password);

    }

    public function test_sorter_login(): void
    {
    
        $sorter = Sorter::factory()->create([
            'name' => 'Sorter',
            'age' => 30,
            'email' => 'sorter@ejemplo.com',
            'password' => Hash::make('password123'),
            'status' => 1
        ]);

        $response = $this->post('/login', [
            'email' => 'sorter@ejemplo.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('lotteries.index'));
        $this->assertAuthenticatedAs($sorter, 'sorter');
    }

}