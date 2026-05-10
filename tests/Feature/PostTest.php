<?php

namespace Tests\Feature;
//just to test logics
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_guest_cannot_create_post(): void
    {
        $response = $this->post('/posts', [
            'title' => 'Test Post',
            'content' => 'Test Content',
        ]);

        $response->assertRedirect('/login');
    }
}