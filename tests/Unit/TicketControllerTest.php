<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Lottery;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show()
    {
        $lottery = Lottery::factory()->create([
            'date' => '2024-07-01',
            'status' => 2,
        ]);

        $ticket = Ticket::factory()->create([
            'code' => 123,
            'number_1' => 5,
            'number_2' => 30,
            'number_3' => 10,
            'number_4' => 13,
            'number_5' => 16,
            'price' => 2000,
            'date' => '2024-07-01',
            'lottery_id' => $lottery->id,
        ]);

        $response = $this->post(route('tickets.show'), ['ticket_code' => 'LG123']);
        $response->assertStatus(302);
    }
}
