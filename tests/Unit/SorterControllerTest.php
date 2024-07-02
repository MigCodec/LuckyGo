<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Sorter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\SorterController;
class SorterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_toggle():void{
        $status=false;
        $sorter = Sorter::factory()->create(["name"=>"soy un test","age"=>40,"email"=>"test@jaja.com","password"=>"password","status"=>$status]);
        $this->actingAs($sorter);
        $response = $this->postJson(route('sorters.toggle', ['sorter' => $sorter->id]));
        $sorter->refresh();
        $this->assertFalse($sorter->status!=$status);
    }

    protected $controller;
    protected function setUp():void
    {
        parent::setUp();
        $this->controller = new SorterController();
    }

    public function test_search_returns_error_message_when_no_results()
    {
        $status=false;
        Sorter::factory()->create(["name" => "Johnny Rockets","age"=>59,"email"=>"test@prueba.com","password"=>"password","status"=>$status]);
        
        $request = new Request(['q' => 'nonexistent']);
        $response = $this->controller->search($request);
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        $viewData = $response->getdata();
      
        $this->assertEmpty($response->getData()['sorters']);
        $this->assertEquals('No se encontraron coincidencias', $viewData['error']);
    }
}

