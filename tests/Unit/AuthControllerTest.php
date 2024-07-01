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
    /*
     * A basic feature test example.
     
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    
    //For admin test
    public function test_change_password_admin():void{

        $administrator = Administrator::factory()->create(["name"=>"test1","email"=>"test10@test1.com","password"=>'password']);
        $password = Hash::make('password');
        $this->actingAs($administrator);
        $response = $this->postJson(route('change_password', ['password1' => 123123 , 'password2' => 123123]));
        $administrator->refresh();
        $this->assertTrue($administrator->password!=$password);

    }

    public function test_change_password_sorter():void{

        $sorter = Sorter::factory()->create(["name"=>"test2","age"=>40,"email"=>"test@test.com","password"=>"password","status"=>1]);
        $password = Hash::make('password');
        $this->actingAs($sorter);
        $response = $this->postJson(route('change_password', ['password1' => 123123 , 'password2' => 123123]));
        $sorter->refresh();
        $this->assertTrue($sorter->password!=$password);

    }

    //For sorter test
    /*public function change_password_test(Request $request){
        
        $sorter = Sorter::create(["name"=>"test2","age"=>40,"email"=>"test@test.com","password"=>"password","status"=>1]);
        $authController = new AuthController();
public function test_toggle():void{
        $sorter = Sorter::create(["name"=>"soy un test","age"=>40,"email"=>"test@jaja.com","password"=>"password","status"=>1]);
        $sorterController = new SorterController();
        $sorterController->toggle($sorter);
        $sorter_changed = Sorter::where("email","test@jaja.com")->first();
        echo("##########################");
        var_dump($sorter_changed->status);
        $this->assertTrue(($sorter_changed->status==1));
    }


    }
    */
}
