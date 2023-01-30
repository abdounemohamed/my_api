<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_key()
    {
        $this->json('POST', 'api/v1/key/post', ['key' => 'test', 'value' => 'test', 'timestamp' => 1674996297])
            ->assertStatus(201)
            ->assertJson([
                'message' => 'key created with success'
            ]);
    }
    
    public function test_get_key()
    {
        $this->json('GET', 'api/v1/key/test')
            ->assertStatus(200)
           ;
    }
}
