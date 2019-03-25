<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\Game;

class DevTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnsDevPage() {
        $response = $this->get('/digital-pattern-library')->getContent();

        $this->assertStringContainsString('Digital Pattern Library', $response);
    }
}
