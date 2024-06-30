<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Http\Controllers\SorterController;
use App\Models\Sorter;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SorterControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
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