<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Sorter;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}