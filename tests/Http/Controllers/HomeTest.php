<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\Game;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnsHTMLFragment() {
        $response = $this->get('/')->getContent();

        $this->assertStringContainsString('<title>Dominion</title>', $response);
    }

    public function testJoinContainsCorrectGameHash() {
        $game = new Game();
        $game->object = '';
        $game->guid = '12345';
        $game->save();

        $response = $this->get('/game/join/12345')->getContent();

        $this->assertStringContainsString('12345', $response);
    }
}
